# Mink (Facebook) PhpWebDriver Driver

[![Latest Stable Version](https://poser.pugx.org/uuf6429/MinkPhpWebDriver/v/stable.svg)](https://packagist.org/packages/uuf6429/MinkPhpWebDriver)
[![CI](https://github.com/minkphp/MinkSelenium2Driver/actions/workflows/tests.yml/badge.svg)](https://github.com/uuf6429/MinkPhpWebDriver/actions/workflows/tests.yml)
[![License](https://poser.pugx.org/uuf6429/MinkPhpWebDriver/license.svg)](https://github.com/uuf6429/MinkPhpWebDriver/blob/main/LICENSE.md)
[![codecov](https://codecov.io/gh/uuf6429/MinkPhpWebDriver/branch/master/graph/badge.svg?token=x2Q2iM3XYz)](https://codecov.io/gh/uuf6429/MinkPhpWebDriver)

The [minkphp/MinkSelenium2Driver](https://github.com/minkphp/MinkSelenium2Driver) library
is [stuck](https://github.com/minkphp/MinkSelenium2Driver/issues/293) [in 2015](https://github.com/minkphp/MinkSelenium2Driver/issues/262#issuecomment-277532163).
This library is the glue between Mink and [php-webdriver/webdriver](https://github.com/php-webdriver/php-webdriver) (
aka [facebook/php-webdriver](https://packagist.org/packages/facebook/webdriver)).

## Usage Example

```php
<?php

use Behat\Mink\Mink,
    Behat\Mink\Session,
    Behat\Mink\Driver\PhpWebDriverDriver;

$url = 'https://example.com';

$mink = new Mink([
    'phpwebdriver' => new Session(new PhpWebDriverDriver(null, null, $url)),
]);

$mink->getSession('phpwebdriver')->getPage()->findLink('Chat')->click();
```

Please refer to [MinkExtension-example](https://github.com/Behat/MinkExtension-example) for an executable example.

## Installation

This library works with [Composer](https://getcomposer.org/).
After [setting up Behat and Mink](https://mink.behat.org/en/latest/#installation), run:

```shell
composer require uuf6429/mink-phpwebdriver-driver
```

## Testing

### To test against a single Selenium instance...

1. Start selenium
    1. The easiest way is with docker and the provided `docker-compose` file:
       ```shell
       docker-compose up
       ```
       _Note that by default that will bring up an instance of the latest Selenium 4._
    2. Otherwise, you will have to download Selenium and set up a target browser.
2. Run the tests
   ```shell
   composer run tests
   ```

### ...whereas to run all the tests, just like GitHub
1. [Install `act`](https://github.com/nektos/act#installation)
2. Run:
```shell
act -P ubuntu-18.04=shivammathur/node:1804
```
_(the custom image is needed to avoid https://github.com/nektos/act/issues/1681)_
