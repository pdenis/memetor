<?php

namespace Snide\Memetor;
/**
 * Class Image
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class Image
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
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Get image metadata
     *
     * @return array
     */
    public function getMetadata()
    {
        if(!is_array($this->metadata)) {
            $this->metadata = array();
        }
        return $this->metadata;
    }
}
