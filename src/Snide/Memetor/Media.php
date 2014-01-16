<?php

namespace Snide\Memetor;

/**
 * Class Media
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
abstract class Media
{
    /**
     * Array of image metadata
     *
     * @var array
     */
    protected $metadata;

    /**
     * File path
     *
     * @var string
     */
    protected $path;

    /**
     * Constructor
     *
     * @param string $path Media path
     */
    public function __construct($path = '')
    {
        if ($path) {
            $this->setPath($path);
        }
    }

    /**
     * Get file path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set file path
     *
     * @param $path
     * @throws \UnexpectedValueException
     */
    public function setPath($path)
    {
        if (!file_exists($path)) {
            throw new \UnexpectedValueException(sprintf('Media path %s doest not exist', $path));
        }
        $this->path = $path;
    }

    /**
     * Get image metadata
     *
     * @return array
     */
    public function getMetadata()
    {
        if (!is_array($this->metadata)) {
            $this->metadata = array();
        }
        return $this->metadata;
    }

    /**
     * Metadata key exist? ?
     *
     * @param string $key Metadata key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->metadata[$key]);
    }

    /**
     * Access metadata key
     *
     * @param string $key Metadata key
     * @throws \Exception
     * @return mixed
     */
    public function get($key)
    {
        if (!$this->has($key)) {
            throw new \Exception(
                sprintf(
                    'Key %s does not exist for image %s',
                    $key,
                    $this->path
                )
            );
        }

        return $this->metadata[$key];
    }
}
