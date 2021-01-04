<?php

namespace Lioo19\Index;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lioo19\Questions\Question;
use Lioo19\User\User;
use Lioo19\Tags\Tags;


// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class IndexController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * Indexpage for start
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function indexAction(): object
    {
        $page = $this->di->get("page");

        $page->add("startpage/startpage", [
            "content" => "HAPPI",
        ]);

        return $page->render([
            "title" => "HAPPI",
        ]);
    }

}
