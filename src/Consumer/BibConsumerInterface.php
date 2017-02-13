<?php

namespace OpenBibIdApi\Consumer;

use OpenBibIdApi\Storage\StorageInterface;
use OpenBibIdApi\Auth\CredentialsInterface;

interface BibConsumerInterface
{
    /**
     * Creates a new BibConsumer.
     *
     * @param \OpenBibIdApi\Auth\CredentialsInterface $credentials
     *   The API credentials.
     * @param \OpenBibIdApi\Storage\StorageInterface $storage
     *   Storage for the request and access token.
     */
    public function __construct(CredentialsInterface $credentials, StorageInterface $storage = null);

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
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     *
     * @throws \OpenBibIdApi\Exception\BibException
     *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
     */
    public function get($url, $params = array(), $queryParams = array());

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
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     *
     * @throws \OpenBibIdApi\Exception\BibException
     *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
     */
    public function getTwoLegged($url, $params = array(), $queryParams = array());

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
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     *
     * @throws \OpenBibIdApi\Exception\BibException
     *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
     */
    public function post($url, $params = array(), $queryParams = array());

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
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     *
     * @throws \OpenBibIdApi\Exception\BibException
     *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
     */
    public function postTwoLegged($url, $params = array(), $queryParams = array());
}
