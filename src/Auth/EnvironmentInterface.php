<?php

namespace OpenBibIdApi\Auth;

interface EnvironmentInterface
{
    /**
     * Creates a new environment.
     *
     * @param string $baseUrl
     *   The base url.
     */
    public function __construct($baseUrl);

    /**
     * Get the environment name.
     *
     * @return string
     *   The environment name.
     */
    public function getName();

    /**
     * Get the base url.
     *
     * @return string
     *   The base url.
     */
    public function getBaseUrl();

    /**
     * Get the request token url.
     *
     * @return string
     *   The request token url.
     */
    public function getRequestTokenUrl();

    /**
     * Get the access token url.
     *
     * @return string
     *   The access token url.
     */
    public function getAccessTokenUrl();

    /**
     * Get the authorize url.
     *
     * @return string
     *   The authorize url.
     */
    public function getAuthorizeUrl();
}
