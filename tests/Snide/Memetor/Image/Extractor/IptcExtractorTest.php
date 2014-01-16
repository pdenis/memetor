<?php

namespace Snide\Memetor\Image\Extractor;

use Snide\Memetor\Image;

/**
 * Class IptcExtractorTest
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class IptcExtractorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var IptcExtractor
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $path = __DIR__.'/../../../../images/image_test.jpg';
        $this->object = new IptcExtractor(new Image($path));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testMetadata()
    {
        $metadata = $this->object->getMetadata();
        $this->assertArrayHasKey('iptc_data', $metadata);
    }
}