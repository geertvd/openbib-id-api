<?php

namespace OpenBibIdApi\Service;

interface OnlineCollectionServiceInterface extends ServiceInterface
{

    /**
     * Get an online collection by id.
     *
     * @param string $id
     *   The online collection id.
     *
     * @return \DOMDocument|NULL
     *   A \DOMDocument containing the XML from the response, NULL if HTTP status
     *   code 204 (No content) was returned.
     *
     * @throws BibApi\Exception\BibException
     *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
     */
    public function getOnlineCollectionById($id);

    /**
     * Get an online collection by its consumer key.
     *
     * @param string $consumerKey
     *   The online collection consumer key.
     *
     * @return \DOMDocument|NULL
     *   A \DOMDocument containing the XML from the response, NULL if HTTP status
     *   code 204 (No content) was returned.
     *
     * @throws BibApi\Exception\BibException
     *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
     */
    public function getOnlineCollectionByConsumerKey($consumerKey);

    /**
     * Get the current logged in user's permissions for an online collection.
     *
     * @param string $consumerKey
     *   The online collection consumer key.
     *
     * @return \DOMDocument|NULL
     *   A \DOMDocument containing the XML from the response, NULL if HTTP status
     *   code 204 (No content) was returned.
     *
     * @throws BibApi\Exception\BibException
     *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
     */
    public function getOnlineCollectionPermissions($consumerKey);

    /**
     * Get the permissions on an online collection for a certain IP address.
     *
     * @param string $consumerKey
     *   The online collection consumer key.
     * @param string $ip
     *   The IP address.
     *
     * @return \DOMDocument|NULL
     *   A \DOMDocument containing the XML from the response, NULL if HTTP status
     *   code 204 (No content) was returned.
     *
     * @throws BibApi\Exception\BibException
     *   When any of the 400, 401, 403, 404 or 421 status codes were returned.
     */
    public function getOnlineCollectionPermissionsByIp($consumerKey, $ip);

}
