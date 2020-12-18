<?php

namespace Lioo19\Me\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Lioo19\Me\Me;

/**
 * Example of FormModel implementation.
 */
class UpdateUserForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);
        $session = $this->di->get("session");

        $username = $session->get("user") ?? null;
        $meObj = new Me();
        $meObj->setDb($this->di->get("dbqb"));
        $data = $meObj->getUserInfo($username);

        $this->form->create(
            [
                "id" => __CLASS__,
                // "legend" => "Legend",
            ],
            [
                "email" => [
                    "type"        => "email",
                    "value"       => $data["email"],
                ],

                "username" => [
                    "type"        => "text",
                    "value"       => $data["username"],
                ],

                "info" => [
                    "type"        => "textarea",
                    "placeholder" => "Add something about yourself!",
                    "value"       => $data["info"],
                ],

                "id" => [
                    "type"        => "hidden",
                    "value"       => $data["id"],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Update",
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
        $info          = $this->form->value("info");
        $id            = $this->form->value("id");

        $user = new Me();
        $user->setDb($this->di->get("dbqb"));
        $user->getUserInfoById($id);
        $user->username = $username;
        $user->email = $email;
        $user->info = $info;
        $user->save();

        $this->form->addOutput("Profile Updated");
        return true;
    }
}
