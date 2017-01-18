<?php

namespace OpenBibIdApi\Auth;

class Credentials implements CredentialsInterface
{
    /**
     * The consumer key.
     *
     * @var string
     */
    protected $consumerKey;

    /**
     * The consumer secret.
     *
     * @var string
     */
    protected $consumerSecret;

    /**
     * The environment.
     *
     * @var \OpenBibIdApi\Auth\EnvironmentInterface
     */
    protected $environment;

    /**
     *
     * @param string $consumerKey
     *   The consumer key.
     * @param string $consumerSecret
     *   The consumer secret.
     * @param \OpenBibIdApi\Auth\EnvironmentInterface $environment
     *   The environment.
     */
    public function __construct($consumerKey, $consumerSecret, EnvironmentInterface $environment)
    {
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
        $this->environment = $environment;
    }

    /**
     * {@inheritdoc}
     */
    public function getConsumerKey()
    {
        return $this->consumerKey;
    }

    /**
     * {@inheritdoc}
     */
    public function getConsumerSecret()
    {
        return $this->consumerSecret;
    }

    /**
     * {@inheritdoc}
     */
    public function getEnvironment()
    {
        return $this->environment;
    }
}
