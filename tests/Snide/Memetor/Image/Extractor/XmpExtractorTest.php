<?php

namespace Snide\Memetor\Image\Extractor;

use Snide\Memetor\Image;

/**
 * Class XmpExtractorTest
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class XmpExtractorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var IptcExtractor
     */
    protected $object;

    /**
     * @var Media
     */
    protected $media;
    /**
     * Exif data
     *
     * @var array
     */
    protected $data;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $path = __DIR__.'/../../../../images/image_test.jpg';
        $this->media = new Image($path);
        $this->object = new XmpExtractor($this->media);
        $this->data = json_decode('{"camera-model":"Canon PowerShot G9","maker":"Canon","width":"1200","height":"857","exposure-time":"1\/20","f-number":"28\/10","iso":"200","focal-length":"7400\/1000","lens":"7.4-44.4 mm"}', true);
    }

    public function testMetadata()
    {
        $metadata = $this->object->getMetadata();
        $this->assertEquals($this->data, $metadata);
        $this->assertEquals('Canon PowerShot G9', $this->object->get('camera-model'));
        $this->assertEquals($this->data, $metadata);
    }

    public function testMedia()
    {
        $this->assertEquals($this->media, $this->object->getMedia());
    }
}