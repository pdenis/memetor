<?php

namespace Snide\Memetor\Image\Extractor;

use Snide\Memetor\Extractor;

/**
 * Class ItpcExtractor
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class IptcExtractor extends Extractor
{
    /**
     * add iptc metadata
     *
     * @return array
     */
    public function getMetadata()
    {
        if(!$this->isInitialized) {
            $size = getimagesize($this->getPath(), $info);
            if(isset($info['APP13'])) {
                $data = iptcparse($info['APP13']);
                $this->isInitialized = true;
                $this->metadata = array_merge(
                    array('iptc_data' => $data),
                    parent::getMetadata()
                );
            }
        }

        return $this->metadata;
    }
}
