<?php

namespace OpenBibIdApi\Consumer;

use OpenBibIdApi\BibConsumer;

class ListConsumer extends BibConsumer {

  /**
   * Get the lists of the current logged in user.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  public function getUserLists() {
    return $this->get('/list');
  }

  /**
   * Get a list by id.
   *
   * @param string $id
   *   The list id.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  public function getListById($id) {
    return $this->get('/list/:id', array(':id' => $id));
  }

  /**
   * Search items in the catalog.
   *
   * @param string $libId
   *   The library id to search.
   * @param string $itemId
   *   The id of the item to search.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  public function getCatalogItems($libId, $itemId) {
    return $this->getTwoLegged('/list/catalog/items', array(), array('libraryId' => $libId, 'itemId' => $itemId));
  }

  /**
   * Get all items of a list.
   *
   * @param string $listId
   *   The list id.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  public function getListItems($listId) {
    return $this->get('/list/:id/items', array(':id' => $listId));
  }
}
