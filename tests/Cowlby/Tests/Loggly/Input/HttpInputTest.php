<?php

namespace Cowlby\Tests\Loggly\Input;

use Cowlby\Loggly\Input\HttpInput;
use Cowlby\Loggly\Input\InputInterface;

class HttpInputTest extends \PHPUnit_Framework_TestCase
{
    private $key = '83e527d7-fad3-4d93-89da-0c2d8c0bcd6c';
    private $input;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        $this->input = new HttpInput($this->key);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->input = null;
    }

    public function testGetSetKeyWorks()
    {
        $this->assertSame($this->key, $this->input->getKey());

        $key = 'key';
        $this->input->setKey($key);
        $this->assertSame($key, $this->input->getKey());
    }

    public function testGetSetFormatWorks()
    {
        $json = 'json';
        $this->input->setFormat($json);
        $this->assertSame($json, $this->input->getFormat());

        $text = 'text';
        $this->input->setFormat($text);
        $this->assertSame($text, $this->input->getFormat());
    }

    public function testFormatDefaultsToJson()
    {
        $this->assertEquals(InputInterface::FORMAT_JSON, $this->input->getFormat());
    }

    public function testSetFormatThrowsException()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->input->setFormat('invalid');
    }
}
