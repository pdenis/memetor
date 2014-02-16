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
 * Class ItpcExtractor
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
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
        if (!$this->isInitialized) {
            getimagesize($this->getPath(), $info);
            if (isset($info['APP13'])) {
                $data = iptcparse($info['APP13']);
                $this->isInitialized = true;
                if (is_array($data)) {
                    $this->metadata = array_merge(
                        $data,
                        parent::getMetadata()
                    );
                }
            }
        }
        return $this->metadata;
    }
}
