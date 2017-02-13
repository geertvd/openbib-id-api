<?php

namespace OpenBibIdApi\Storage;

interface StorageInterface
{
    /**
     * Store a value.
     *
     * @param string $key
     *   The key to store the value under.
     * @param string $value
     *   The value to store.
     */
    public function set($key, $value);

    /**
     * Get a stored value.
     *
     * @param string $key
     *   The key of the value to get.
     * @param mixed $default
     *   The default value to return if the value for this key was not set.
     *
     */
    public function get($key, $default = null);

    /**
     * Delete a stored value.
     *
     * @param string $key
     *   The key of the value to delete.
     */
    public function delete($key);
}
