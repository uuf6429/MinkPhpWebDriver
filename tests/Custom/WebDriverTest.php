<?php

namespace Behat\Mink\Tests\Driver\Custom;

use Behat\Mink\Driver\PhpWebDriverDriver;
use Behat\Mink\Tests\Driver\TestCase;

class WebDriverTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->getSession()->start();
    }

    protected function tearDown(): void
    {
        $this->getSession()->stop();

        parent::tearDown();
    }

    public function testGetWebDriverSessionId(): void
    {
        $driver = $this->getSession()->getDriver();
        $this->assertNotEmpty($driver->getWebDriverSessionId(), 'Started session has an ID');

        $driver = new PhpWebDriverDriver();
        $this->assertNull($driver->getWebDriverSessionId(), 'Not started session don\'t have an ID');
    }
}
