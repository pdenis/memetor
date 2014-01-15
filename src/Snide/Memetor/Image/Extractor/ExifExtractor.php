<?php

namespace Snide\Memetor\Image\Extractor;

use Snide\Memetor\Image\Extractor;

/**
 * Class ExifExtractor
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class ExifExtractor extends Extractor
{
    /**
     * add exif metadata
     *
     * @return array
     */
    public function getMetadata()
    {
        if(!$this->isInitialized) {
            $data = exif_read_data($this->getPath());
            $this->metadata = array_merge(
                array('exif_data' => $data),
                parent::getMetadata()
            );

            $this->isInitialized = true;
        }

        return $this->metadata;
    }
}