<?php

namespace OpenBibIdApi\Consumer;

use OpenBibIdApi\BibConsumer;

class LibraryConsumer extends BibConsumer {

  /**
   * Get a list of all libraries.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  public function getLibraryList() {
    return $this->getTwoLegged('/library/list');
  }

  /**
   * Get a library by id.
   *
   * @param string $id
   *   The library id.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  public function getLibraryById($id) {
    return $this->getTwoLegged('/library/id/' . $id);
  }

  /**
   * Get a library by pbs code.
   *
   * @param string $pbs
   *   The pbs code.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  public function getLibraryByPBS($pbs) {
    return $this->getTwoLegged('/library/pbscode', array(), array('pbsCode' => $pbs));
  }

  /**
   * Get a library by catalog url.
   *
   * @param string $url
   *   The catalog url.
   *
   * @return \DOMDocument|NULL
   *   A \DOMDocument containing the XML from the response, NULL if HTTP status
   *   code 204 (No content) was returned.
   *
   * @throws BibApi\Exception\BibException
   *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
   */
  public function getLibraryByCatalogUrl($url) {
    return $this->getTwoLegged('/library/catalog', array(), array('catalog' => $url));
  }

}
