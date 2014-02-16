<?php

/*
 * This file is part of the Snide memetor package.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Memetor;

use Snide\Memetor\Media;

/**
 * Class Extractor
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
abstract class Extractor extends Media
{
    /**
     * @var Media
     */
    protected $media;

    /**
     * Metadata are loaded?
     *
     * @var boolean
     */
    protected $isInitialized;

    /**
     * Constructor
     *
     * @param Media $media
     */
    public function __construct(Media $media)
    {
        $this->setMedia($media);
    }

    /**
     * Get media
     *
     * @return Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set media
     *
     * @param Media $media
     */
    public function setMedia(Media $media)
    {
        $this->media = $media;
        $this->isInitialized = false;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->media->getPath();
    }
}
