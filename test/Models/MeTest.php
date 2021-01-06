<?php

namespace Lioo19\Me;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Lioo19\Me\Me;

/**
 * Test the IpDefault Model
 */
class MeTest extends TestCase
{
    /**
     * Setup before each testcase just like the router
     * would set it up.
     */
    protected function setUp(): void
    {
        global $di;

        // Init service container $di to contain $app as a service
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config_/di");

        // Create and initiate the controller
        $this->class = new MeMock();
        $this->class->setDb($di->get("dbqb"));
    }

    /**
     * Test Get user info
     * Works!
     */
    public function testGetUserInfo()
    {
        $user = $this->class->getUserInfo("Linn");
        $this->assertIsArray($user);
    }

    /**
     * Test get info by id
     * Works!
     */
    public function testGetUserInfoById()
    {
        $user = $this->class->getUserInfoById("1");
        $this->assertIsArray($user);
    }
}
