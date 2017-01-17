<?php

namespace OpenBibIdApi\Storage;

class SessionStorage implements StorageInterface
{

    /**
     * The prefix to add before the keys when storing values in the session.
     *
     * @var string
     */
    protected $prefix;

    /**
     * Creates a new \OpenBibIdApi\Storage\SessionStorage.
     *
     * @param string $prefix
     *   The prefix to add before the keys when storing values in the session.
     */
    public function __construct($prefix = '')
    {
        $this->prefix = $prefix;
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $default = null)
    {
        $key = $this->prefix . $key;
        return isset($_SESSION[$key]) ? unserialize($_SESSION[$key]) : $default;
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        $key = $this->prefix . $key;
        $_SESSION[$key] = serialize($value);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($key)
    {
        $key = $this->prefix . $key;
        unset($_SESSION[$key]);
    }

}
