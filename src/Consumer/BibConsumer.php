<?php

namespace OpenBibIdApi\Consumer;

use OpenBibIdApi\Auth\CredentialsInterface;
use OpenBibIdApi\Exception\BibException;
use OpenBibIdApi\Storage\SessionStorage;
use OpenBibIdApi\Storage\StorageInterface;
use ZendOAuth\Client;
use ZendOAuth\Consumer;
use ZendOAuth\Exception\InvalidArgumentException;
use ZendOAuth\Token\Access;
use ZendOAuth\Token\TokenInterface;

class BibConsumer implements BibConsumerInterface
{
    const BIB_REQUEST_TOKEN = 'BIB_REQUEST_TOKEN';
    const BIB_ACCESS_TOKEN = 'BIB_ACCESS_TOKEN';
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    /**
     * OAuth consumer.
     *
     * @var \ZendOAuth\Consumer
     */
    protected $consumer;

    /**
     * Storage for the request and access token.
     *
     * @var \OpenBibIdApi\Storage\StorageInterface
     */
    protected $storage;

    /**
     * OAuth config.
     *
     * @see https://framework.zend.com/manual/2.4/en/modules/zendoauth.introduction.html
     *
     * @var array
     */
    protected $oauthConfig;

    /**
     *  The API Credentials.
     *
     * @var \OpenBibIdApi\Auth\CredentialsInterface
     */
    protected $credentials;

    /**
     * Creates a new BibConsumer.
     *
     * @param \OpenBibIdApi\Auth\CredentialsInterface $credentials
     *   The API credentials.
     * @param StorageInterface $storage
     *   Storage for the request and access token.
     */
    public function __construct(CredentialsInterface $credentials, StorageInterface $storage = null)
    {
        $this->credentials = $credentials;
        $this->oauthConfig = array(
            'siteUrl' => $credentials->getEnvironment()->getBaseUrl(),
            'consumerKey' => $credentials->getConsumerKey(),
            'consumerSecret' => $credentials->getConsumerSecret(),
            'requestTokenUrl' => $credentials->getEnvironment()->getRequestTokenUrl(),
            'accessTokenUrl' => $credentials->getEnvironment()->getAccessTokenUrl(),
            'authorizeUrl' => $credentials->getEnvironment()->getAuthorizeUrl(),
        );
        $this->consumer = new Consumer($this->oauthConfig);
        $this->storage = is_null($storage)
            ? new SessionStorage($credentials->getEnvironment()->getName())
            : $storage;
    }

    /**
     * {@inheritdoc}
     */
    public function get($url, $params = array(), $queryParams = array())
    {
        if (!$this->hasAccessToken()) {
            $this->fetchAccessToken($_GET);
        }

        $config = $this->oauthConfig;
        $token = $this->getAccessToken();
        $client = $token->getHttpClient($config);
        return $this->doRequest(
            $client,
            $url,
            array(
                'urlParams' => $params,
                'queryParams' => $queryParams,
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getTwoLegged($url, $params = array(), $queryParams = array())
    {
        if (!$this->hasRequestToken()) {
            $this->fetchRequestToken();
        }
        $config = $this->oauthConfig;
        $client = new Client($config);
        $client->setToken(new Access());
        return $this->doRequest(
            $client,
            $url,
            array(
                'urlParams' => $params,
                'queryParams' => $queryParams,
              )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function post($url, $params = array(), $queryParams = array())
    {
        if (!$this->hasAccessToken()) {
            $this->fetchAccessToken($_GET);
        }

        $config = $this->oauthConfig;
        $token = $this->getAccessToken();
        $client = $token->getHttpClient($config);
        return $this->doRequest(
            $client,
            $url,
            array(
                'urlParams' => $params,
                'queryParams' => $queryParams,
                'method' => static::METHOD_POST,
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function postTwoLegged($url, $params = array(), $queryParams = array())
    {
        if (!$this->hasRequestToken()) {
            $this->fetchRequestToken();
        }
        $config = $this->oauthConfig;
        $client = new Client($config);
        $client->setToken(new Access());
        return $this->doRequest(
            $client,
            $url,
            array(
                'urlParams' => $params,
                'queryParams' => $queryParams,
                'method' => static::METHOD_POST,
            )
        );
    }

    /**
     * Executes a request.
     *
     * @param \ZendOAuth\Client $client
     *   The client that will execute the request.
     * @param string $url
     *   The URL to request.
     * @param array $options
     *   An array of options:
     *     - urlParams: An array of replacements for the url:
     *         $url: 'https://mijn.bibliotheek.be/openbibid/rest/library/id/:id'
     *         urlParams: [':id' => 2199]
     *         Values between {} are taken from the access token:
     *         $url:
     *           'https://mijn.bibliotheek.be/openbibid/rest/user/info/:userId'
     *         urlParams: [':userId' => '{userId}']
     *     - queryParams: An array of query parameters for GET requests or POST
     *       data for POST requests.
     *     - method: One of the \Zend\Http\Request::METHOD_* constants.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status
     *   code 204 (No content) was returned.
     *
     * @throws \OpenBibIdApi\Exception\BibException
     *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
     */
    protected function doRequest(Client $client, $url, $options = array())
    {
        $options += array(
            'urlParams' => array(),
            'queryParams' => array(),
            'method' => static::METHOD_GET,
        );
        $token = $client->getToken();

        // Replace parameters in the url.
        $urlReplacements = $this->getParameterReplacements($options['urlParams'], $token);
        $url = str_replace(array_keys($urlReplacements), array_values($urlReplacements), $url);

        // Replace query parameters.
        $queryReplacements = $this->getParameterReplacements($options['queryParams'], $token);
        $queryParams = array_merge($options['queryParams'], $queryReplacements);

        // Process query parameters.
        $queryParams = $this->processQueryParameters($queryParams);

        // Set the request uri.
        $client->setUri($this->credentials->getEnvironment()->getBaseUrl() . $url);

        // Set the parameters.
        switch ($options['method']) {
            case static::METHOD_POST:
                $client->setParameterPost($queryParams);
                break;

            case static::METHOD_GET:
            default:
                $client->setParameterGet($queryParams);
                break;
        }

        // Set the request method and send the request.
        $client->setMethod($options['method']);
        $response = $client->send();

        // Below are all possible error codes as described bij de api
        // documentation.
        switch ($response->getStatusCode()) {
            // No content.
            case 204:
                return null;
            // Bad request.
            case 400:
            // Missing Authorization header.
            case 401:
            // Unauthorized.
            case 403:
            // Not found.
            case 404:
            // Misdirected request.
            case 421:
                throw new BibException($response->getReasonPhrase(), $response->getStatusCode());
        }
        $doc = new \DOMDocument();
        $doc->loadXML($response->getBody());
        return $doc;
    }

    /**
     * Replace values in an array with parameters from a token.
     *
     * @param array $parameters
     *   An array with parameters to replace. Values surrounded with {} will be
     *   replaced with their corresponding token parameter.
     * @param \ZendOAuth\Token\TokenInterface $token
     *   The token with the parameters.
     *
     * @return array
     *   An array of replacements, keyed by the corresponding array key in
     *   $parameters.
     */
    protected function getParameterReplacements($parameters, TokenInterface $token)
    {
        $replacements = $parameters;
        foreach ($parameters as $key => $param) {
            if (strpos($param, '{') === 0 && strpos($param, '}') === strlen($param) - 1) {
                $replacements[$key] = $token->getParam(substr($param, 1, -1));
            }
        }
        return $replacements;
    }

    /**
     * Fetches the request token.
     *
     * @return $this
     */
    protected function fetchRequestToken()
    {
        // Fetching a new request token. Remove any old access tokens.
        $this->storage->delete(static::BIB_ACCESS_TOKEN);
        // Fetch a request token.
        $token = $this->consumer->getRequestToken();
        // Persist the token to storage.
        $this->storage->set(static::BIB_REQUEST_TOKEN, $token);

        return $this;
    }

    /**
     * Fetches the access token.
     *
     * @param array $queryData
     *   GET data returned in user's redirect from Provider.
     * @param bool $retry
     *   Internal use only.
     *
     * @return $this
     *
     * @throws \ZendOAuth\Exception\InvalidArgumentException
     *   On invalid authorization token.
     */
    protected function fetchAccessToken($queryData, $retry = true)
    {
        if (!$this->hasRequestToken()) {
            $this->consumer->setCallbackUrl($this->getCurrentUri());
            $this->fetchRequestToken();
            $this->consumer->redirect();
        }
        try {
            $token = $this->consumer->getAccessToken(
                $queryData,
                $this->getRequestToken()
            );
        } catch (InvalidArgumentException $e) {
            if ($retry) {
                // We might have a corrupt/invalid request token. Delete it and
                // retry once.
                $this->storage->delete(static::BIB_REQUEST_TOKEN);
                $this->storage->delete(static::BIB_ACCESS_TOKEN);
                return $this->fetchAccessToken($queryData, false);
            }
            throw $e;
        }
        // We got a new access token, we can remove the request token now.
        $this->storage->delete(static::BIB_REQUEST_TOKEN);
        $this->storage->set(static::BIB_ACCESS_TOKEN, $token);

        return $this;
    }

    /**
     * Checks if a request token has been set.
     *
     * @return bool
     *   true if a request token has been set, false otherwise.
     */
    protected function hasRequestToken()
    {
        return (bool) $this->getRequestToken();
    }

    /**
     * Checks if a access token has been set.
     *
     * @return bool
     *   true if a access token has been set, false otherwise.
     */
    protected function hasAccessToken()
    {
        return (bool) $this->getAccessToken();
    }

    /**
     * Getter for the request token.
     *
     * @return \ZendOAuth\Token\Request
     *   The request token.
     */
    protected function getRequestToken()
    {
        return $this->storage->get(static::BIB_REQUEST_TOKEN);
    }

    /**
     * Getter for the access token.
     *
     * @return \ZendOAuth\Token\Access
     *   The access token.
     */
    protected function getAccessToken()
    {
        return $this->storage->get(static::BIB_ACCESS_TOKEN);
    }

    /**
     * Gets the current uri.
     *
     * @return string
     *   The current uri.
     */
    protected function getCurrentUri()
    {
        $uri = isset($_SERVER['REQUEST_URI'])
            ? $_SERVER['REQUEST_URI']
            : false;
        if (!$uri) {
            $uri = $_SERVER['SCRIPT_NAME'];
            if (isset($_SERVER['argv']) || isset($_SERVER['QUERY_STRING'])) {
                $uri .= '?';
                $uri .= isset($_SERVER['argv'])
                    ? $_SERVER['argv'][0]
                    : $_SERVER['QUERY_STRING'];
            }
        }
        return 'http'
            . (isset($_SERVER['HTTPS']) ? 's' : '')
            . '://'
            . $_SERVER['HTTP_HOST']
            . '/'
            . ltrim($uri, '/');
    }

    /**
     * Processes an array of query parameters to a readable format.
     *
     * @param array $queryParams
     *   The parameters to be processes.
     *
     * @return array
     *   The processed array of query parameters.
     */
    protected function processQueryParameters($queryParams)
    {
        foreach ($queryParams as $name => $value) {
            if (is_bool($value)) {
                $queryParams[$name] = $value ? 'true' : 'false';
            }
        }
        return $queryParams;
    }
}
