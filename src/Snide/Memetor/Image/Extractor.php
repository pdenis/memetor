<?php

namespace Snide\Memetor\Image;

use Snide\Memetor\Image;

/**
 * Class Extractor
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
abstract class Extractor extends Image
{
    /**
     * @var Image
     */
    protected $image;

    /**
     * Metadata are loaded?
     *
     * @var boolean
     */
    protected $isInitialized;

    public function __construct(Image $image)
    {
        $this->image = $image;
        $this->isInitialized = false;
    }
}
