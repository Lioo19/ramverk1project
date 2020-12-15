<?php

namespace Lioo19\Questions\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Lioo19\Questions\Questions;

/**
 * Example of FormModel implementation.
 */
class UserLoginForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);

        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Sign in"
            ],
            [
                "username" => [
                    "type"        => "text",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],

                "password" => [
                    "type"        => "password",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Login",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ],

        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        $session = $this->di->get("session");
        $session->delete("user");
        // Get values from the submitted form
        $username      = $this->form->value("username");
        $password      = $this->form->value("password");

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $res = $user->verifyPassword($username, $password);

        if (!$res) {
            $this->form->rememberValues();
            $this->form->addOutput("username and password did not match");
            $session->set("login", null);
            return false;
        }
        $session->set("login", "yes");
        $session->set("user", [$user->getUserInfo($username)]);


        $this->form->addOutput("User " . $user->username . " logged in.");
        return true;
    }

    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackButton()
    {
        // Get values from the submitted form
        $username      = $this->form->value("username");
        $password      = $this->form->value("password");


        // $user is null if user is not found
        if (!$user || !password_verify($password, $user->password)) {
           $this->form->rememberValues();
           $this->form->addOutput("BLEPP");
           return false;
        }

        $this->form->addOutput("TEST");
        return true;
    }
}
