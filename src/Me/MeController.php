<?php

namespace Lioo19\Me;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lioo19\Me\HTMLForm\CreateUserForm2;
use Lioo19\Me\HTMLForm\UpdateUserForm;
use Lioo19\Me\Me;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class MeController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * @var $data description
     */
    private $data;



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize(): void
    {
        $session = $this->di->get("session");

        $username = $session->get("user") ?? null;

        $info = new Me();
        $info->setDb($this->di->get("dbqb"));

        $this->data = $info->getUserInfo($username);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function indexActionGet(): object
    {
        $page = $this->di->get("page");

        if (!$this->data["username"]) {
            $page->add("me/noaccess");
            return $page->render([
                "title" => "No Access",
            ]);
        }
        $page->add("me/me", [
            "content" => $this->data,
        ]);

        return $page->render([
            "title" => "Profile",
        ]);
    }


    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function updateAction(): object
    {
        $page = $this->di->get("page");
        $form = new UpdateUserForm($this->di);
        $form->check();

        $page->add("me/update", [
            "content" => $form->getHTML(),
            "data" => $this->data
        ]);

        return $page->render([
            "title" => "Update profile",
        ]);
    }

    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function bAction(): object
    {
        $page = $this->di->get("page");
        $form = new CreateUserForm2($this->di);
        $form->check();

        $page->add("me/update", [
            "content" => $form->getHTML(),
            "data" => $this->data
        ]);

        return $page->render([
            "title" => "Update profile",
        ]);
    }
}
