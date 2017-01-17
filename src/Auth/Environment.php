<?php

namespace OpenBibIdApi\Auth;

class Environment implements EnvironmentInterface
{

    /**
     * The base url.
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * Creates a new \OpenBibIdApi\Auth\Environment.
     *
     * @param string $baseUrl
     *   The base url.
     */
    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * Get a production environment instance.
     *
     * @return \OpenBibIdApi\Auth\EnvironmentInterface
     *   The production environment instance.
     */
    public static function production()
    {
        return new self('https://mijn.bibliotheek.be/openbibid/rest');
    }

    /**
     * Get a staging environment instance.
     *
     * @return \OpenBibIdApi\Auth\EnvironmentInterface
     *   The staging environment instance.
     */
    public static function staging()
    {
        return new self('https://staging-mijn.bibliotheek.be/openbibid/rest');
    }


    /**
     * {@inheritdoc}
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestTokenUrl()
    {
        return $this->baseUrl. '/requestToken';
    }


    /**
     * {@inheritdoc}
     */
    public function getAccessTokenUrl()
    {
        return $this->baseUrl. '/accessToken';
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthorizeUrl()
    {
        return $this->baseUrl. '/auth/authorize';
    }

}
