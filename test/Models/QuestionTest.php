<?php

namespace Lioo19\Questions;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Lioo19\Questions\Question;

/**
 * Test the IpDefault Model
 */
class QuestionTest extends TestCase
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
        $this->class = new QuestionMock();
        $this->class->setDb($di->get("dbqb"));
    }

    /**
     * Test getAllQ
     *
     */
    public function testGetAllQ()
    {
        $all = $this->class->getAllQ();
        $this->assertIsArray($all);
    }

    /**
     * Test single Comment
     */
    public function testGetAll()
    {
        $questions = $this->class->getAll();
        $this->assertIsArray($questions);
    }

    /**
     * Test single Comment
     */
    public function testQsByUsernameFail()
    {
        $questions = $this->class->getQsByUsername("Lkdjfgkdfjhg");
        $this->assertIsArray($questions);
    }
}
