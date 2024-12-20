<?php

namespace Tests\Feature;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;

use Tests\TestCase;

class LoginTest extends TestCase
{
    protected $driver;

    public function setUp(): void
    {
        parent::setUp();

        $username = env('LAMBDATEST_USERNAME');
        $accessKey = env('LAMBDATEST_ACCESS_KEY');
        
        $url = "https://{$username}:{$accessKey}@hub.lambdatest.com/wd/hub";
        
        $capabilities = array(
            "browserName" => "Chrome",
            "browserVersion" => "131",
            "LT:Options" => array(
                "username" => "piyush.awr",
                "accessKey" => "gv5nEgeCb2EAV3Sjrz2F6HsJwFa7qmUJUahyZDReujYgubShYt",
                "visual" => true,
                "video" => true,
                "platformName" => "Windows 10",
                "build" => "Health Credit Testing",
                "project" => "HealthCreditTesting",
                "name" => "UserLogin",
                "console" => "true",
                "w3c" => true,
                "plugin" => "php-lavarel",
                "tunnel" => true
            )
        );

        $this->driver = RemoteWebDriver::create($url, $capabilities);
    }

    public function tearDown(): void
    {
        $this->driver->quit();
        parent::tearDown();
    }

    public function testExample()
    {
        $this->driver->get('http://health_credit.test/login');
        $emailInput = $this->driver->findElement(WebDriverBy::id('email'));
        $emailInput->sendKeys('piyush.awr@gmail.com');

        $pwdInput = $this->driver->findElement(WebDriverBy::id('password'));
        $pwdInput->sendKeys('j7TUgSWKr6Vytvx');

        $pwdInput->submit();

        $newUrl = $this->driver->getCurrentUrl();
        $userAccount = $this->driver->findElements(WebDriverBy::id('dropdownUserAvatarButton'));

        $this->assertEquals('http://health_credit.test/', $newUrl);
        $this->assertNotEmpty($userAccount);

    }
}