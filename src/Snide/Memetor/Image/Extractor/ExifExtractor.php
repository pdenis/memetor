<?php

/*
 * This file is part of the Snide memetor package.
 *
 * (c) Pascal DENIS <pascal.denis.75@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Snide\Memetor\Image\Extractor;

use Snide\Memetor\Extractor;

/**
 * Class ExifExtractor
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
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
        if (!$this->isInitialized) {
            $data = exif_read_data($this->getPath());
            $this->metadata = array_merge(
                $this->parseData($data),
                parent::getMetadata()
            );

            $this->isInitialized = true;
        }

        return $this->metadata;
    }

    /**
     * Parse metadata and create a clean array
     *
     * @param $metadata
     * @return array
     */
    protected function parseData($metadata)
    {
        $parsedData = array();
        if (isset($metadata['COMPUTED'])) {
            $parsedData = array_merge($metadata['COMPUTED'], $parsedData);
            unset($metadata['COMPUTED']);
        }

        return array_merge($parsedData, $metadata);
    }
}
