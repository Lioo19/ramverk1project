<?php

namespace Lioo19\Comments;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Lioo19\Comments\Comment;

/**
 * Test the IpDefault Model
 */
class CommentTest extends TestCase
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
        $this->class = new CommentMock();
        $this->class->setDb($di->get("dbqb"));
    }

    /**
     * Test getAllQ
     * Works!
     */
    public function testGetAllQ()
    {
        $allComments = $this->class->getAllQ();
        $this->assertIsArray($allComments);
    }

    /**
     * Test single Comment
     * Works!
     */
    public function testGetCommentsByParentId()
    {
        $comments = $this->class->GetCommentsByParentId("1");
        $this->assertIsArray($comments);
    }
}
