<?php

namespace OpenBibIdApi;

use OpenBibIdApi\Exception\BibException;
use OpenBibIdApi\Consumer\LibraryConsumer;
use OpenBibIdApi\Consumer\ListConsumer;
use OpenBibIdApi\Consumer\OnlineCollectionConsumer;
use OpenBibIdApi\Consumer\UserConsumer;
use OpenBibIdApi\Storage\SessionStorage;
use OpenBibIdApi\Storage\StorageInterface;
use ZendOAuth\Client;
use ZendOAuth\Consumer;
use ZendOAuth\Token\Access;

class BibConsumer {

  const BIB_REQUEST_TOKEN = 'BIB_REQUEST_TOKEN';
  const BIB_ACCESS_TOKEN = 'BIB_ACCESS_TOKEN';

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
  protected $config;

  /**
   *  The base url.
   *
   * @var string
   */
  protected $baseUrl;

  /**
   * The current environment ('prod', 'qa', 'staging').
   *
   * @var string
   */
  protected $environment;

  /**
   * Creates a new BibConsumer.
   *
   * @param string $consumerKey
   *   The consumer key.
   * @param string $consumerSecret
   *   The consumer secret.
   * @param string $environment
   *   The current environment ('prod', 'qa', 'staging').
   * @param StorageInterface $storage
   *   Storage for the request and access token.
   */
  public function __construct($consumerKey, $consumerSecret, $environment = 'prod', StorageInterface $storage = NULL) {
    $this->baseUrl = $environment === 'prod' ? 'https://mijn.bibliotheek.be/openbibid/rest' : 'https://staging-mijn.bibliotheek.be/openbibid/rest';
    $this->environment = $environment;
    $this->config = array(
      'siteUrl' => $this->baseUrl,
      'consumerKey' => $consumerKey,
      'consumerSecret' => $consumerSecret,
      'requestTokenUrl' => $this->baseUrl . '/requestToken',
      'accessTokenUrl' => $this->baseUrl . '/accessToken',
      'authorizeUrl' => $this->baseUrl . '/auth/authorize',
    );
    $this->consumer = new Consumer($this->config);
    $this->storage = is_null($storage) ? new SessionStorage($this->environment) : $storage;
  }

  /**
   * Gets the library consumer.
   *
   * @return \OpenBibIdApi\Consumer\LibraryConsumer
   *   The library consumer.
   */
  public function library() {
    return new LibraryConsumer($this->config['consumerKey'], $this->config['consumerSecret'], $this->environment, $this->storage);
  }

  /**
   * Gets the user consumer.
   *
   * @return \OpenBibIdApi\Consumer\UserConsumer
   *   The user consumer.
   */
  public function user() {
    return new UserConsumer($this->config['consumerKey'], $this->config['consumerSecret'], $this->environment, $this->storage);
  }

  /**
   * Gets the online collections consumer
   *
   * @return \OpenBibIdApi\Consumer\OnlineCollectionConsumer
   *   The online collections consumer.
   */
  public function onlineCollection() {

    return new OnlineCollectionConsumer($this->config['consumerKey'], $this->config['consumerSecret'], $this->environment, $this->storage);
  }
  /**
   * Gets the lists consumer.
   *
   * @return \OpenBibIdApi\Consumer\ListConsumer
   *   The lists consumer.
   */
  public function lists() {
    return new ListConsumer($this->config['consumerKey'], $this->config['consumerSecret'], $this->environment, $this->storage);
  }

  /**
   * Executes a POST request using two-legged authentication.
   *
   * @param string $url
   *   The URL to request.
   * @param array $params
   *   An array of replacements for the url:
   *     $url: 'https://mijn.bibliotheek.be/openbibid/rest/library/id/:id'
   *     $params: [':id' => 2199]
   *     Values between {} are taken from the access token:
   *     $url: 'https://mijn.bibliotheek.be/openbibid/rest/user/info/:userId'
   *     $params: [':userId' => '{userId}']
   * @param array $queryParams
   *   An array of query parameters.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  protected function get($url, $params = array(), $queryParams = array()) {
    if (!$this->hasAccessToken()) {
      $this->fetchAccessToken($_GET);
    }

    $config = $this->config;
    $token = $this->getAccessToken();
    $client = $token->getHttpClient($config);
    return $this->doRequest($client, $url, array('urlParams' => $params,'queryParams' => $queryParams));
  }

  /**
   * Executes a GET request using two-legged authentication.
   *
   * @param string $url
   *   The URL to request.
   * @param array $params
   *   An array of replacements for the url:
   *     $url: 'https://mijn.bibliotheek.be/openbibid/rest/library/id/:id'
   *     $params: [':id' => 2199]
   *     Values between {} are taken from the access token:
   *     $url: 'https://mijn.bibliotheek.be/openbibid/rest/user/info/:userId'
   *     $params: [':userId' => '{userId}']
   * @param array $queryParams
   *   An array of query parameters.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  protected function getTwoLegged($url, $params = array(), $queryParams = array()) {
    if (!$this->hasRequestToken()) {
      $this->fetchRequestToken();
    }
    $config = $this->config;
    $client = new Client($config);
    $client->setToken(new Access());
    return $this->doRequest($client, $url, array('urlParams' => $params,'queryParams' => $queryParams));
  }

  /**
   * Executes a POST request.
   *
   * @param string $url
   *   The URL to request.
   * @param array $params
   *   An array of replacements for the url:
   *     $url: 'https://mijn.bibliotheek.be/openbibid/rest/library/id/:id'
   *     $params: [':id' => 2199]
   *     Values between {} are taken from the access token:
   *     $url: 'https://mijn.bibliotheek.be/openbibid/rest/user/info/:userId'
   *     $params: [':userId' => '{userId}']
   * @param array $queryParams
   *   An array of POST data.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  protected function post($url, $params = array(), $queryParams = array()) {
    if (!$this->hasAccessToken()) {
      $this->fetchAccessToken($_GET);
    }

    $config = $this->config;
    $token = $this->getAccessToken();
    $client = $token->getHttpClient($config);
    return $this->doRequest($client, $url, array('urlParams' => $params,'queryParams' => $queryParams, 'method' => \Zend\Http\Request::METHOD_POST));
  }

  /**
   * Executes a POST request using two-legged authentication.
   *
   * @param string $url
   *   The URL to request.
   * @param array $params
   *   An array of replacements for the url:
   *     $url: 'https://mijn.bibliotheek.be/openbibid/rest/library/id/:id'
   *     $params: [':id' => 2199]
   *     Values between {} are taken from the access token:
   *     $url: 'https://mijn.bibliotheek.be/openbibid/rest/user/info/:userId'
   *     $params: [':userId' => '{userId}']
   * @param array $queryParams
   *   An array of POST data.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  protected function postTwoLegged($url, $params = array(), $queryParams = array()) {
    if (!$this->hasRequestToken()) {
      $this->fetchRequestToken();
    }
    $config = $this->config;
    $client = new Client($config);
    $client->setToken(new Access());
    return $this->doRequest($client, $url, array('urlParams' => $params,'queryParams' => $queryParams, 'method' => \Zend\Http\Request::METHOD_POST));
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
   *         $url: 'https://mijn.bibliotheek.be/openbibid/rest/user/info/:userId'
   *         urlParams: [':userId' => '{userId}']
   *     - queryParams: An array of query parameters for GET requests or POST
   *       data for POST requests.
   *     - method: One of the \Zend\Http\Request::METHOD_* constants.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  protected function doRequest(Client $client, $url, $options = array()) {
    $options += array(
      'urlParams' => array(),
      'queryParams' => array(),
      'method' => \Zend\Http\Request::METHOD_GET,
    );
    $token = $client->getToken();
    $urlParams = $options['urlParams'];
    foreach ($urlParams as $key => $param) {
      if (strpos($param, '{') === 0 && strpos($param, '}') === strlen($param) - 1) {
        $param = $token->getParam(substr($param, 1, -1));
      }
      $url = str_replace($key, $param, $url);
    }
    $queryParams = $options['queryParams'];
    foreach ($queryParams as $key => $param) {
      if (strpos($param, '{') === 0 && strpos($param, '}') === strlen($param) - 1) {
        $queryParams[$key] = $token->getParam(substr($param, 1, -1));
      }
    }
    $client->setUri($this->baseUrl . $url);
    $client->setParameterGet($queryParams);
    $client->setMethod($options['method']);
    $response = $client->send();

    $doc = new \DOMDocument();
    // Below are all possible error codes as described bij de api documentation.
    switch ($response->getStatusCode()) {
      // No content.
      case 204:
        return NULL;
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
    $doc->loadXML($response->getBody());
    return $doc;
  }

  /**
   * Fetches the request token.
   *
   * @return $this
   */
  protected function fetchRequestToken() {
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
   *
   * @return $this
   */
  protected function fetchAccessToken($queryData) {
    if (!$this->hasRequestToken()) {
      $this->consumer->setCallbackUrl($this->getCurrentUri());
      $this->fetchRequestToken();
      $this->consumer->redirect();
    }
    $token = $this->consumer->getAccessToken(
      $queryData, $this->getRequestToken()
    );
    // We got a new access token, we can remove the request token now.
    $this->storage->delete(static::BIB_REQUEST_TOKEN);
    $this->storage->set(static::BIB_ACCESS_TOKEN, $token);

    return $this;
  }

  /**
   * Checks if a request token has been set.
   *
   * @return bool
   *   TRUE if a request token has been set, FALSE otherwise.
   */
  protected function hasRequestToken() {
    return (bool) $this->getRequestToken();
  }

  /**
   * Checks if a access token has been set.
   *
   * @return bool
   *   TRUE if a access token has been set, FALSE otherwise.
   */
  protected function hasAccessToken() {
    return (bool) $this->getAccessToken();
  }

  /**
   * Getter for the request token.
   *
   * @return \ZendOAuth\Token\Request
   *   The request token.
   */
  protected function getRequestToken() {
    return $this->storage->get(static::BIB_REQUEST_TOKEN);
  }

  /**
   * Getter for the access token.
   *
   * @return \ZendOAuth\Token\Access
   *   The access token.
   */
  protected function getAccessToken() {
    return $this->storage->get(static::BIB_ACCESS_TOKEN);
  }

  /**
   * Gets the current uri.
   *
   * @return string
   *   The current uri.
   */
  protected function getCurrentUri() {

    if (isset($_SERVER['REQUEST_URI'])) {
      $uri = $_SERVER['REQUEST_URI'];
    }
    else {
      if (isset($_SERVER['argv'])) {
        $uri = $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['argv'][0];
      }
      elseif (isset($_SERVER['QUERY_STRING'])) {
        $uri = $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['QUERY_STRING'];
      }
      else {
        $uri = $_SERVER['SCRIPT_NAME'];
      }
    }
    return 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . '/' . ltrim($uri, '/');
  }

}
