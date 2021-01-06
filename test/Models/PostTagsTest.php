<?php

namespace Lioo19\Tags;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Lioo19\Tags\PostTags;

/**
 * Test the SampleController.
 */
class PostTagsTest extends TestCase
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
        $this->class = new PostTags();
        $this->class->setDb($di->get("dbqb"));
    }

    /**
     * Test Get user info
     * Works!
     */
    public function testGetTagIdsByPostId()
    {
        $tags = $this->class->getTagIdsByPostId("1");
        $this->assertIsArray($tags);
    }

    /**
     * Test Get user info
     * Works!
     */
    public function testGetPostIdsByTagId()
    {
        $tags = $this->class->getPostIdsByTagId("1");
        $this->assertIsArray($tags);
    }
}
