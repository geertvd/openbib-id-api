<?php

namespace OpenBibIdApi\Storage;

class FileStorage implements StorageInterface
{
    /**
     * The path to store the files under.
     *
     * @var string
     */
    protected $path;

    /**
     * Creates a new \OpenBibIdApi\Storage\FileStorage.
     *
     * @param string $path
     *   The path to store the files under.
     */
    public function __construct($path = '')
    {
        $this->path = realpath($path) . '/';
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $default = null)
    {
        $key = $this->path . $key . '.txt';
        return file_exists($key) ? unserialize(file_get_contents($key)) : $default;
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        $key = $this->path . $key . '.txt';
        file_put_contents($key, serialize($value));
    }

    /**
     * {@inheritdoc}
     */
    public function delete($key)
    {
        $key = $this->path . $key . '.txt';
        if (file_exists($key)) {
           unlink($key);
        }
    }

}
