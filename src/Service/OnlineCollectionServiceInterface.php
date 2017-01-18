<?php

namespace OpenBibIdApi\Service;

interface OnlineCollectionServiceInterface extends ServiceInterface
{
    /**
     * Get an online collection by id.
     *
     * @param string $collectionId
     *   The online collection id.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     */
    public function getOnlineCollectionById($collectionId);

    /**
     * Get an online collection by its consumer key.
     *
     * @param string $consumerKey
     *   The online collection consumer key.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     */
    public function getOnlineCollectionByConsumerKey($consumerKey);

    /**
     * Get the current logged in user's permissions for an online collection.
     *
     * @param string $consumerKey
     *   The online collection consumer key.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     */
    public function getOnlineCollectionPermissions($consumerKey);

    /**
     * Get the permissions on an online collection for a certain IP address.
     *
     * @param string $consumerKey
     *   The online collection consumer key.
     * @param string $ipAddress
     *   The IP address.
     *
     * @return \DOMDocument|null
     *   A \DOMDocument containing the XML from the response, null if HTTP
     *   status code 204 (No content) was returned.
     */
    public function getOnlineCollectionPermissionsByIp($consumerKey, $ipAddress);
}
