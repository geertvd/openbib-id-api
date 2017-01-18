<?php

namespace OpenBibIdApi\OAuth;

use Zend\Stdlib\ArrayUtils;
use ZendOAuth\Client as OAuthClient;
use ZendOAuth\Token\Access;

class Client extends OAuthClient
{
    /**
     * {@inheritdoc}
     */
    public function __construct($oauthOptions, $uri = null, $config = null)
    {
        if ($oauthOptions !== null) {
            if ($oauthOptions instanceof \Traversable) {
                $oauthOptions = ArrayUtils::iteratorToArray($oauthOptions);
            }
            if (!isset($oauthOptions['token'])) {
                $oauthOptions['token'] = new Access();
            }
        }
        parent::__construct($oauthOptions, $uri, $config);
    }
}
