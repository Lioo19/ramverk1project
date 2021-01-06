<?php

namespace Lioo19\User;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Lioo19\User\User;

/**
 * Test the SampleController.
 */
class UserTest extends TestCase
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
        $this->class = new User();
        $this->class->setDb($di->get("dbqb"));
    }

    /**
     * Test
     *
     */
    public function testGetUserInfo()
    {
        $user = $this->class->getUserInfo("Linn");
        $this->assertIsArray($user);
    }

    /**
     * Test
     *
     */
    public function testGetUserInfoById()
    {
        $user = $this->class->getUserInfoById("1");
        $this->assertIsArray($user);
    }

    /**
     * Test
     *
     */
    public function testGetAllUsers()
    {
        $user = $this->class->getAllUsers();
        $this->assertIsArray($user);
    }
}
