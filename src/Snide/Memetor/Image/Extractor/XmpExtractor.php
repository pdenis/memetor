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
 * Class XmpExtractor
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class XmpExtractor extends Extractor
{
    protected $regexps = array(
        "copyright"         => "/<dc:rights>\s*<rdf:Alt>\s*<rdf:li xml:lang=\"x-default\">(.+)<\/rdf:li>\s*<\/rdf:Alt>\s*<\/dc:rights>/",
        "author"            => "/<dc:creator>\s*<rdf:Seq>\s*<rdf:li>(.+)<\/rdf:li>\s*<\/rdf:Seq>\s*<\/dc:creator>/",
        "title"             => "/<dc:title>\s*<rdf:Alt>\s*<rdf:li xml:lang=\"x-default\">(.+)<\/rdf:li>\s*<\/rdf:Alt>\s*<\/dc:title>/",
        "description"       => "/<dc:description>\s*<rdf:Alt>\s*<rdf:li xml:lang=\"x-default\">(.+)<\/rdf:li>\s*<\/rdf:Alt>\s*<\/dc:description>/",
        "camera-model"      => "/tiff:Model=\"(.[^\"]+)\"/",
        "maker"             => "/tiff:Make=\"(.[^\"]+)\"/",
        "width"             => "/tiff:ImageWidth=\"(.[^\"]+)\"/",
        "height"            => "/tiff:ImageLength=\"(.[^\"]+)\"/",
        "exposure-time"     => "/exif:ExposureTime=\"(.[^\"]+)\"/",
        "f-number"          => "/exif:FNumber=\"(.[^\"]+)\"/",
        "iso"               => "/<exif:ISOSpeedRatings>\s*<rdf:Seq>\s*<rdf:li>(.+)<\/rdf:li>\s*<\/rdf:Seq>\s*<\/exif:ISOSpeedRatings>/",
        "focal-length"      => "/exif:FocalLength=\"(.[^\"]+)\"/",
        "user-comment"      => "/<exif:UserComment>\s*<rdf:Alt>\s*<rdf:li xml:lang=\"x-default\">(.+)<\/rdf:li>\s*<\/rdf:Alt>\s*<\/exif:UserComment>/",
        "datetime-original" => "/xmp:CreateDate=\"(.[^\"]+)\"/",
        "lens"              => "/aux:Lens=\"(.[^\"]+)\"/"
    );

    /**
     * add exif metadata
     *
     * @return array
     */
    public function getMetadata()
    {
        if (!$this->isInitialized) {
            $data = $this->parseData($this->readData());
            $this->isInitialized = true;

            if (is_array($data)) {
                $this->metadata = array_merge(
                    $data,
                    parent::getMetadata()
                );
            }
        }

        return $this->metadata;
    }

    /**
     * Read XMP metadata from file
     * @return null|string
     * @throws \RuntimeException
     */
    protected function readData()
    {
        if (false === ($pointer = fopen($this->getPath(), 'r'))) {
            throw new \RuntimeException('Could not open file for reading');
        }

        $chunkSize = 50000;
        $buffer= null;

        $chunk = fread($pointer, $chunkSize);
        if (false !== ($posStart = strpos($chunk, '<x:xmpmeta'))) {
            $buffer = substr($chunk, $posStart);
            $posEnd = strpos($buffer, '</x:xmpmeta>');
            $buffer = substr($buffer, 0, $posEnd + 12);
        }
        fclose($pointer);

        return $buffer;
    }

    /**
     * Parse XMP data
     * @param $xmlData
     * @return array
     */
    protected function parseData($xmlData)
    {
        $data = array();
        foreach ($this->regexps as $k => $v) {
            $r = null;
            preg_match ($v, $xmlData, $r);
            if (isset($r[1])) {
                $data[$k] = $r[1];
            }
        ///    if (in_array($k["name"], array("f number", "focal lenght"))) eval("\$xmp_item = ".$xmp_item.";");
         //  $xmp_parsed[$k["name"]] = str_replace("&#xA;", "\n", $xmp_item);
        }
        return $data;
    }
}
