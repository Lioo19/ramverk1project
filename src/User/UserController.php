<?php

namespace Lioo19\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lioo19\User\HTMLForm\UserLoginForm;
use Lioo19\User\HTMLForm\CreateUserForm;
use Lioo19\Me\Me;
use Lioo19\Questions\Question;
use Lioo19\Comments\Comment;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class UserController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * Index action
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function indexAction(): object
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
        $form = new UserLoginForm($this->di);
        $form->check();

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
     * Method to extract all users from database - name, gravatar and score
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function singleuserAction(): object
    {
        $page = $this->di->get("page");
        $questions = new Question();
        $comments = new Comment();
        $questions->setDb($this->di->get("dbqb"));
        $comments->setDb($this->di->get("dbqb"));
        $request = $this->di->get("request");

        $username = $request->getGet("username", null);

        $allCs = $comments->getCommentsByUsername($username);
        $allQs = $questions->getQsByUsername($username);

        //Use me-method for getting info by name

        $page->add("users/singleuserwq", [
            "user"  => $username,
            "allQs" => $allQs,
            "allCs" => $allCs
        ]);

        return $page->render([
            "title" => "user",
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
