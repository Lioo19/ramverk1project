<?php

namespace Lioo19\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lioo19\User\HTMLForm\UserLoginForm;
use Lioo19\User\HTMLForm\CreateUserForm;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class UserController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * @var $data description
     */
    //private $data;



    // /**
    //  * The initialize method is optional and will always be called before the
    //  * target method/action. This is a convienient method where you could
    //  * setup internal properties that are commonly used by several methods.
    //  *
    //  * @return void
    //  */
    // public function initialize() : void
    // {
    //     ;
    // }



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

        $page->add("anax/v2/article/default", [
            "content" => "An index page",
        ]);

        return $page->render([
            "title" => "A index page",
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
    public function signinAction(): object
    {
        $page = $this->di->get("page");
        $session = $this->di->get("session");
        $form = new UserLoginForm($this->di);
        $form->check();

        // $login = $session->set("login", null);
        // $login = $session->get("login", null);
        // var_dump($session);
        // var_dump($login);

        $page->add("users/signin", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "A login page",
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
    public function signupAction(): object
    {
        $page = $this->di->get("page");
        $form = new CreateUserForm($this->di);
        $form->check();

        $page->add("users/signup", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "A signUp user page",
        ]);
    }


    /**
     * Method to extract all users from database - name, gravatar and score
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function allAction(): object
    {
        $page = $this->di->get("page");
        $user = new User();
        $user->setDb($this->di->get("dbqb"));

        $all = $user->getAllUsers();

        $page->add("users/all", [
            "content" => $all,
        ]);

        return $page->render([
            "title" => "A create user page",
        ]);
    }

    /**
     * Link to kill session (logout)
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function signoutAction(): object
    {
        $page = $this->di->get("page");
        $session = $this->di->get("session");

        $session->destroy();

        $page->add("users/signout", [
            "content" => "mep",
        ]);

        return $page->render([
            "title" => "A create user page",
        ]);
    }
}
