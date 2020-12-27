<?php

namespace Lioo19\Questions\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Lioo19\Questions\Question;
use Lioo19\Me\Me;

/**
 * Example of FormModel implementation.
 */
class CreateAnswerForm extends FormModel
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
        $request = $this->di->get("request");

        $parentid = $request->getGet("id", null);

        $username = $session->get("user") ?? null;
        $meObj = new Me();
        $meObj->setDb($this->di->get("dbqb"));
        $owner = $meObj->getUserInfo($username);

        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "New Answer"
            ],
            [
                "title" => [
                    "type"        => "hidden",
                    "value"       => "response",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],

                "body" => [
                    "type"        => "textarea",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],

                "tags" => [
                    "type"        => "text",
                    "placeholder" => "separate with comma",
                ],
                "id" => [
                    "type"        => "hidden",
                    "value"       => $owner["id"],
                ],

                "username" => [
                    "type"        => "hidden",
                    "value"       => $owner["username"],
                ],
                "parentid" => [
                    "type"        => "text",
                    "value"       => $parentid,
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Send Q",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ],
        );
    }



    /**
     * DENNA BEHÖVER LÖSA TAGS BÄTTRE!
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        $session = $this->di->get("session");

        $title         = $this->form->value("title");
        $body          = $this->form->value("body");
        $tags          = $this->form->value("tags");
        $ownerid       = $this->form->value("id");
        $ownerusername = $this->form->value("username");
        $parentid      = $this->form->value("parentid");

        $question = new Question();
        $question->setDb($this->di->get("dbqb"));

        $question->title          = $title;
        $question->body           = $body;
        $question->tags           = $tags;
        $question->ownerid        = $ownerid;
        $question->ownerusername  = $ownerusername;
        $question->parentid       = $parentid;

        $question->save();

        $this->form->addOutput("Answer added");
        return true;
    }
}
