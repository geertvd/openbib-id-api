<?php

namespace OpenBibIdApi\Service;

class OnlineCollectionService extends Service implements OnlineCollectionServiceInterface
{

    /**
     * {@inheritdoc}
     */
    public function getOnlineCollectionById($collectionId)
    {
        return $this->consumer->getTwoLegged(
            '/subscription/id/:subscriptionId',
            array(':subscriptionId' => $collectionId)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getOnlineCollectionByConsumerKey($consumerKey)
    {
        return $this->consumer->getTwoLegged(
            '/subscription/key/:key',
            array(':key' => $consumerKey)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getOnlineCollectionPermissions($consumerKey)
    {
        return $this->consumer->get(
            '/permissions/user/:userId/consumer/:consumerKey/read',
            array(':userId' => '{userId}', ':consumerKey' => $consumerKey)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getOnlineCollectionPermissionsByIp($consumerKey, $ipAddress)
    {
        return $this->consumer->getTwoLegged(
            '/permissions/ip/consumer/:consumerKey/read',
            array(':consumerKey' => $consumerKey), array('ip' => $ipAddress)
        );
    }
}
