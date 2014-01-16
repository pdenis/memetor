<?php

namespace Snide\Memetor\Image\Extractor;

use Snide\Memetor\Image;

/**
 * Class ExifExtractorTest
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class ExifExtractorTest extends \PHPUnit_Framework_TestCase
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
        $this->object = new ExifExtractor($this->media);
        $this->data = json_decode('
        {
        "html":"width=\"1200\" height=\"857\"",
        "Height":857,
        "Width":1200,
        "IsColor":1,
        "ByteOrderMotorola":0,
        "ApertureFNumber":"f\/2.8",
        "FileName":"image_test.jpg",
        "FileDateTime":1389904228,
        "FileSize":712398,
        "FileType":2,
        "MimeType":"image\/jpeg",
        "SectionsFound":"ANY_TAG, IFD0, EXIF",
        "Make":"Canon",
        "Model":"Canon PowerShot G9",
        "XResolution":"300\/1",
        "YResolution":"300\/1",
        "ResolutionUnit":2,
        "DateTime":"2008:01:24 18:47:06",
        "Exif_IFD_Pointer":160,
        "ExposureTime":"1\/20",
        "FNumber":"28\/10",
        "ISOSpeedRatings":200,
        "ExifVersion":"0220",
        "DateTimeOriginal":"2008:01:25 19:37:42",
        "DateTimeDigitized":"2008:01:25 19:37:42",
        "ShutterSpeedValue":"4321928\/1000000",
        "ApertureValue":"2970854\/1000000",
        "ExposureBiasValue":"0\/3",
        "MaxApertureValue":"95\/32",
        "MeteringMode":5,
        "Flash":16,
        "FocalLength":"7400\/1000",
        "FocalPlaneXResolution":"1600000\/291",
        "FocalPlaneYResolution":"1200000\/219",
        "FocalPlaneResolutionUnit":2,
        "SensingMethod":2,
        "FileSource":"\u0003",
        "CustomRendered":0,
        "ExposureMode":0,
        "WhiteBalance":0,
        "DigitalZoomRatio":"4000\/4000",
        "SceneCaptureType":0
        }', true);
    }

    public function testMetadata()
    {
        $metadata = $this->object->getMetadata();
        $this->assertEquals($this->data, $metadata);
        $this->assertEquals('image_test.jpg', $this->object->get('FileName'));
    }

    public function testMedia()
    {
        $this->assertEquals($this->media, $this->object->getMedia());
    }
}