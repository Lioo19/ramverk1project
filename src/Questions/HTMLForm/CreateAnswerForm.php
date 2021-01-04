<?php

namespace Lioo19\Questions\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Lioo19\Me\Me;
use Lioo19\MyTextFilter\MyTextFilter;
use Lioo19\Questions\Question;

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

        //to get qname and all answers and count them, to create new title
        $qObj = new Question();
        $qObj->setDb($this->di->get("dbqb"));
        $answers = $qObj->getAnswersByParentId($parentid);
        $question = $qObj->getSingleQById($parentid);

        $counter = 0;
        for ($i=0; $i < count($answers); $i++) {
            $counter += 1;
        }

        $counter += 1;

        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "New Answer"
            ],
            [
                "title" => [
                    "type"        => "hidden",
                    "value"       => $question["title"] . $counter,
                ],

                "body" => [
                    "type"        => "textarea",
                    "placeholder" => "use markdown to style your answer"
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
                    "type"        => "hidden",
                    "value"       => $parentid,
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Answer",
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
        $filter = new MyTextFilter();

        $title         = $this->form->value("title");
        $body          = $filter->parse($this->form->value("body"), ["markdown"]);
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
