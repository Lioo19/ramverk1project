<?php

namespace Lioo19\User\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Lioo19\User\User;

/**
 * Example of FormModel implementation.
 */
class CreateUserForm extends FormModel
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
                // "legend" => "Legend",
            ],
            [
                "email" => [
                    "type"        => "email",
                ],

                "username" => [
                    "type"        => "text",
                ],

                "password" => [
                    "type"        => "password",
                    "description" => "At least 6 characters",
                ],

                "password-again" => [
                    "type"        => "password",
                    "validation" => [
                        "match" => "password"
                    ],
                ],

                "i-agree" => [
                    "type"        => "checkbox",
                    "description" => "I agree to this student-
                                    project saving my entered data",
                ],
                "submit" => [
                    "type" => "submit",
                    "value" => "Create user",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
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
        // Get values from the submitted form
        $email         = $this->form->value("email");
        $username      = $this->form->value("username");
        $password      = $this->form->value("password");
        $passwordAgain = $this->form->value("password-again");
        $iagree        = $this->form->value("i-agree");

        if ($iagree === false) {
            $this->form->rememberValues();
            $this->form->addOutput("Agree to data agreement");
            return false;
        }

        // Check password matches
        if ($password !== $passwordAgain) {
            $this->form->rememberValues();
            $this->form->addOutput("Password did not match.");
            return false;
        }

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->username     = $username;
        $user->email        = $email;

        //Active record seems to have issues with default
        $user->reputation   = 0;
        $user->created      = date('Y-m-d H:i:s');
        $user->setPassword($password);
        $user->save();

        $this->form->addOutput("User " . $username . " was created.");
        return true;
    }
}
