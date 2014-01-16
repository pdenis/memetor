<?php

namespace Snide\Memetor;
/**
 * Class ImageTest
 *
 * @author Pascal DENIS <pascal.denis@businessdecision.com>
 */
class ImageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Image
     */
    protected $object;

    protected $path;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->path = __DIR__.'/../../images/image_test.jpg';
        $this->object = new Image($this->path);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testPath()
    {
        $this->assertEquals($this->path, $this->object->getPath());
        $path2 = '/tmp/test_image_not_found';
        try {
            $this->object->setPath($path2);
            $this->fail('File path does not exist. This test must fail');
        } catch(\Exception $e) {
            $this->assertInstanceOf('\UnexpectedValueException', $e);
        }
    }

    public function testMetadata()
    {
        $this->assertEquals(array(), $this->object->getMetadata());
    }

    public function testGet()
    {
        try {
            $value = $this->object->get('unknown');
            $this->fail('File path does not exist. This test must fail');
        } catch(\Exception $e) {
            $this->assertEquals('Key unknown does not exist for image '.$this->path, $e->getMessage());
        }
    }
}
