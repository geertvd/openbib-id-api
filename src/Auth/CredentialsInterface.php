<?php

namespace OpenBibIdApi\Auth;

interface CredentialsInterface
{
    /**
     * Get the consumer key.
     *
     * @return string
     */
    public function getConsumerKey();

    /**
     * Get the consumer secret.
     *
     * @return string
     */
    public function getConsumerSecret();

    /**
     * Get the environment.
     *
     * @return \OpenBibIdApi\Auth\EnvironmentInterface
     */
    public function getEnvironment();
}
