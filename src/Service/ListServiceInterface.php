<?php

namespace OpenBibIdApi\Service;

interface ListServiceInterface extends ServiceInterface
{
    /**
     * Get the lists of the current logged in user.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     */
    public function getUserLists();

    /**
     * Get a list by id.
     *
     * @param string $listId
     *   The list id.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     */
    public function getListById($listId);

    /**
     * Search items in the catalog.
     *
     * @param string $libId
     *   The library id to search.
     * @param string $itemId
     *   The id of the item to search.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     */
    public function getCatalogItems($libId, $itemId);

    /**
     * Get all items of a list.
     *
     * @param string $listId
     *   The list id.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     */
    public function getListItems($listId);
}
