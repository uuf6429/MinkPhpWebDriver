<?php

namespace Behat\Mink\Tests\Driver;

use Behat\Mink\Driver\PhpWebDriverDriver;

class PhpWebDriverDriverConfig extends AbstractConfig
{
    public static function getInstance(): self
    {
        return new self();
    }

    /**
     * {@inheritdoc}
     */
    public function createDriver()
    {
        $browser = getenv('WEB_FIXTURES_BROWSER') ?: null;
        $seleniumHost = $_SERVER['DRIVER_URL'];

        return new PhpWebDriverDriver($browser, null, $seleniumHost);
    }

    /**
     * {@inheritdoc}
     */
    protected function supportsCss(): bool
    {
        return true;
    }

    public function mapRemoteFilePath($file): string
    {
        if (!isset($_SERVER['TEST_MACHINE_BASE_PATH'])) {
            $_SERVER['TEST_MACHINE_BASE_PATH'] = realpath(
                    dirname(__DIR__) . '/vendor/mink/driver-testsuite/web-fixtures'
                ) . DIRECTORY_SEPARATOR;
        }

        return parent::mapRemoteFilePath($file);
    }
}
