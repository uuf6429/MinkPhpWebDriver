<?php

namespace Behat\Mink\Tests\Driver\Custom;

use Behat\Mink\Driver\PhpWebDriverDriver;
use Behat\Mink\Exception\DriverException;
use Behat\Mink\Tests\Driver\TestCase;

class FirefoxDesiredCapabilitiesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $driver = $this->getSession()->getDriver();
        if ($driver instanceof PhpWebDriverDriver && $driver->getBrowserName() !== 'firefox') {
            $this->markTestSkipped('This test only applies to Firefox');
        }
    }

    protected function tearDown(): void
    {
        if ($this->getSession()->isStarted()) {
            $this->getSession()->stop();
        }

        parent::tearDown();
    }

    public function testGetDesiredCapabilities(): void
    {
        $caps = [
            'browserName' => 'firefox',
            'version' => '30',
            'platform' => 'ANY',
            'browserVersion' => '30',
            'browser' => 'firefox',
            'name' => 'PhpWebDriver Mink Driver Test',
            'deviceOrientation' => 'portrait',
            'deviceType' => 'tablet',
            'moz:firefoxOptions' => [
                'prefs' => [],
            ],
        ];

        $driver = new PhpWebDriverDriver('firefox', $caps);
        $this->assertNotEmpty($driver->getDesiredCapabilities(), 'desiredCapabilities empty');
        $this->assertIsArray($driver->getDesiredCapabilities());
        $this->assertEquals($caps, $driver->getDesiredCapabilities());
    }

    public function testSetDesiredCapabilities(): void
    {
        $this->expectException(DriverException::class);
        $this->expectExceptionMessage('Unable to set desiredCapabilities, the session has already started');
        $caps = [
            'browserName' => 'firefox',
            'version' => '30',
            'platform' => 'ANY',
            'browserVersion' => '30',
            'browser' => 'firefox',
            'name' => 'PhpWebDriver Mink Driver Test',
            'deviceOrientation' => 'portrait',
            'deviceType' => 'tablet',
        ];
        $session = $this->getSession();
        $session->start();
        $driver = $session->getDriver();
        $driver->setDesiredCapabilities($caps);
    }
}
