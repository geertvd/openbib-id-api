<?php

namespace OpenBibIdApi\Service;

use OpenBibIdApi\Value\UserActivities\Hold;
use OpenBibIdApi\Value\UserActivities\Loan;
use OpenBibIdApi\Value\UserActivities\UserActivities;

interface UserServiceInterface extends ServiceInterface
{
    /**
     * Get the user info of the currently logged in user.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     */
    public function getUserInfo();

    /**
     * Get the user profile of the currently logged in user.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     */
    public function getUserProfile();

    /**
     * Get the available online collections for currently logged in user.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     */
    public function getUserAvailableOnlineCollections();

    /**
     * Get the library accounts of the currently logged in user.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
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
     */
    public function getUserLibraryAccount($accountId);

    /**
     * Get the activities of a library account of the currently logged in user.
     *
     * @param string $accountId
     *   The id of a library account.
     * @param bool $triggerServiceRefresh
     *   Whether membership should be synced before fetching the activities.
     * @param bool $includeLoanHistory
     *   Whether the loan history should by included in the user activities.
     *
     * @return UserActivities
     *   An object containing information about user activities.
     */
    public function getUserActivities($accountId, $triggerServiceRefresh = false, $includeLoanHistory = true);

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
     */
    public function getUserLoanHistory($accountId);

    /**
     * Get the welcome messages of the currently logged in user.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     */
    public function getUserWelcomeMessages();

    /**
     * Get the libraries of the currently logged in user.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
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
     */
    public function getUserLibraryListAndOnlineCollection($collectionKey);

    /**
     * Cancels a reservation.
     *
     * @param string $accountId
     *   The id of the library account.
     * @param Hold $hold
     *   The hold object.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     */
    public function cancelReservation($accountId, Hold $hold);

    /**
     * Renews a loan.
     *
     * @param string $accountId
     *   The id of the library account.
     * @param Loan $loan
     *   The loan object.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     */
    public function renewLoan($accountId, Loan $loan);
}
