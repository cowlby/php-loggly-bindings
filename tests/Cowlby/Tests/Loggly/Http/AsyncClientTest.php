<?php

namespace Cowlby\Tests\Loggly\Http;

use Cowlby\Loggly\Http\AsyncClient;

class AsyncClientTest extends \PHPUnit_Framework_TestCase
{
    private $input;
    private $client;

    protected function setUp()
    {
        $this->input = $this->getMock('Cowlby\Loggly\Input\HttpInputInterface');
        $this->client = new AsyncClient($this->input);
    }

    protected function tearDown()
    {
        $this->input = null;
        $this->client = null;
    }

    public function testGetSetInputWorks()
    {
        $this->assertSame($this->input, $this->client->getInput());
    }
}
