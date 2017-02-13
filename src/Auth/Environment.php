<?php

namespace OpenBibIdApi\Auth;

class Environment implements EnvironmentInterface
{
    /**
     * The name of the environment.
     *
     * @var string
     */
    protected $name;

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
     * @param string $name
     *   The name of the environment (e.g. 'prod', 'qa', 'test').
     */
    public function __construct($baseUrl, $name = 'environment')
    {
        $this->baseUrl = $baseUrl;
        $this->name = $name;
    }

    /**
     * Get a production environment instance.
     *
     * @return \OpenBibIdApi\Auth\EnvironmentInterface
     *   The production environment instance.
     */
    public static function production()
    {
        return new static('https://mijn.bibliotheek.be/openbibid/rest', 'prod');
    }

    /**
     * Get a staging environment instance.
     *
     * @return \OpenBibIdApi\Auth\EnvironmentInterface
     *   The staging environment instance.
     */
    public static function staging()
    {
        return new static('https://staging-mijn.bibliotheek.be/openbibid/rest', 'staging');
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
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
