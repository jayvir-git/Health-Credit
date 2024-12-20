<?php

namespace Tests\Feature;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    protected $driver;

    public function setUp(): void
    {
        parent::setUp();

        $username = env('jtc240');
        $accessKey = env('HHHWMvXOS5jRj5TsPnHqWML859oOiAHlBF1y5mUeAHWAZ5gzql');

        $url = "https://{$username}:{$accessKey}@hub.lambdatest.com/wd/hub";

        $capabilities = array(
            "browserName" => "Chrome",
            "browserVersion" => "131",
            "LT:Options" => array(
                "username" => "jtc240",
                "accessKey" => "HHHWMvXOS5jRj5TsPnHqWML859oOiAHlBF1y5mUeAHWAZ5gzql",
                "video" => true,
                "platformName" => "Windows 10",
                "build" => "health-credit-v1",
                "project" => "health-credit",
                "name" => "auth_test",
                "w3c" => true,
                "plugin" => "php-lavarel",
                "tunnel" => true,
            )
        );

        $this->driver = RemoteWebDriver::create($url, $capabilities);
    }

    public function tearDown(): void
    {
        // Quit the WebDriver session
        if ($this->driver) {
            $this->driver->quit();
        }
        parent::tearDown();
    }

    public function testAdminCanAccessDashboard()
    {
        $adminEmail = 'jay@temp.com';
        $adminPassword = 'password';
        $baseUrl = env('APP_URL', '/');

        // Navigate to the login page
        $this->driver->get("{$baseUrl}/login");
        // Fill out the login form
        $this->driver->findElement(WebDriverBy::id('email'))->sendKeys($adminEmail);
        $this->driver->findElement(WebDriverBy::id('password'))->sendKeys($adminPassword)->submit();
        // $this->driver->findElement(WebDriverBy::cssSelector('button[type="submit"]'))->click();

        // Wait for the dashboard to load (adjust time as needed)
        sleep(3);

        // Check if the admin dashboard URL is loaded
        $hasDashboard = $this->driver->findElements(WebDriverBy::id('dashboard'));
        $this->assertNotEmpty($hasDashboard);

        echo "Test passed: Admin user has access to the dashboard.";
    }
}
