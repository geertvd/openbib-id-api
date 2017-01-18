<?php

namespace OpenBibIdApi\Service;

interface LibraryServiceInterface extends ServiceInterface
{
    /**
     * Get a list of all libraries.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     */
    public function getLibraryList();

    /**
     * Get a library by id.
     *
     * @param string $libraryId
     *   The library id.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     */
    public function getLibraryById($libraryId);

    /**
     * Get a library by pbs code.
     *
     * @param string $pbs
     *   The pbs code.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     */
    public function getLibraryByPBS($pbs);

    /**
     * Get a library by catalog url.
     *
     * @param string $url
     *   The catalog url.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     */
    public function getLibraryByCatalogUrl($url);
}
