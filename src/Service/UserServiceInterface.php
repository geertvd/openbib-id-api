<?php

namespace OpenBibIdApi\Service;

interface UserServiceInterface extends ServiceInterface
{

    /**
     * Get the user info of the currently logged in user.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     *
     * @throws BibApi\Exception\BibException
     *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
     */
    public function getUserInfo();

    /**
     * Get the user profile of the currently logged in user.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     *
     * @throws BibApi\Exception\BibException
     *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
     */
    public function getUserProfile();

    /**
     * Get the available online collections for currently logged in user.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     *
     * @throws BibApi\Exception\BibException
     *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
     */
    public function getUserAvailableOnlineCollections();

    /**
     * Get the library accounts of the currently logged in user.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     *
     * @throws BibApi\Exception\BibException
     *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
     */
    public function getUserLibraryAccounts();

    /**
     * Get a library account by id for the currently logged in user.
     *
     * @param string $accountId
     *   The id of a library account.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     *
     * @throws BibApi\Exception\BibException
     *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
     */
    public function getUserLibraryAccount($accountId);

    /**
     * Get the activities of a library account of the currently logged in user.
     *
     * @param string $accountId
     *   The id of a library account.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     *
     * @throws BibApi\Exception\BibException
     *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
     */
    public function getUserActivities($accountId);

    /**
     * Get the loan history of a library account of the currently logged in
     * user.
     *
     * @param string $accountId
     *   The id of the library account.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     *
     * @throws BibApi\Exception\BibException
     *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
     */
    public function getUserLoanHistory($accountId);

    /**
     * Get the welcome messages of the currently logged in user.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     *
     * @throws BibApi\Exception\BibException
     *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
     */
    public function getUserWelcomeMessages();

    /**
     * Get the libraries of the currently logged in user.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     *
     * @throws BibApi\Exception\BibException
     *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
     */
    public function getUserLibraryList();

    /**
     * Get the libraries of the currently logged in user that gives him rights
     * to a specific online collection.
     *
     * @param string $collectionKey
     *   The online collection consumer key.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     *
     * @throws BibApi\Exception\BibException
     *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
     */
    public function getUserLibraryListAndOnlineCollection($collectionKey);
}
