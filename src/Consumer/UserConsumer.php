<?php

namespace OpenBibIdApi\Consumer;

use OpenBibIdApi\BibConsumer;

class UserConsumer extends BibConsumer {

  /**
   * Get the user info of the currently logged in user.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  public function getUserInfo() {
    return $this->get('/user/info/:userId', array(':userId' => '{userId}'));
  }

  /**
   * Get the user profile of the currently logged in user.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  public function getUserProfile() {
    return $this->get('/user/:userId', array(':userId' => '{userId}'));
  }

  /**
   * Get the available online collections for currently logged in user.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  public function getUserAvailableOnlineCollections() {
    return $this->get('/permissions/user/:userId/consumer/list', array(':userId' => '{userId}'));
  }

  /**
   * Get the library accounts of the currently logged in user.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  public function getUserLibraryAccounts() {
    return $this->get('/libraryaccounts/list/:userId', array(':userId' => '{userId}'));
  }

  /**
   * Get a library account by id for the currently logged in user.
   *
   * @param string $id
   *   The id of a library account.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  public function getUserLibraryAccount($id) {
    return $this->get('/libraryaccounts/:id', array(':id' => $id));
  }

  /**
   * Get the activities of a library account of the currently logged in user.
   *
   * @param string $id
   *   The id of a library account.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  public function getUserActivities($id) {
    return $this->get('/libraryaccounts/:id/activities', array(':id' => $id));
  }

  /**
   * Get the loan history of a library account of the currently logged in user.
   *
   * @param string $id
   *   The id of the library account.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  public function getUserLoanHistory($id) {
    return $this->get('/libraryaccounts/:id/loanhistory', array(':id' => $id));
  }

  /**
   * Get the welcome messages of the currently logged in user.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  public function getUserWelcomeMessages() {
    return $this->get('/user/:userId/welcomemessages', array(':userId' => '{userId}'));
  }

  /**
   * Get the libraries of the currently logged in user.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  public function getUserLibraryList() {
    return $this->get('/library/list', array(), array('uid' => '{userId}'));
  }

  /**
   * Get the libraries of the currently logged in user that gives him rights to
   * a specific online collection.
   *
   * @param string $collectionConsumerKey
   *   The online collection consumer key.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  public function getUserLibraryListAndOnlineCollection($collectionConsumerKey) {
    return $this->get('/library/list', array(), array('uid' => '{userId}', 'consumerKey' => $collectionConsumerKey));
  }
}
