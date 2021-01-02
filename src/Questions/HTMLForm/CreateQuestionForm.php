<?php

namespace Lioo19\Questions\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Lioo19\Questions\Question;
use Lioo19\Me\Me;
use Lioo19\Tags\Tags;
use Lioo19\Tags\PostTags;

/**
 * Example of FormModel implementation.
 */
class CreateQuestionForm extends FormModel
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
                "legend" => "New Question"
            ],
            [
                "title" => [
                    "type"        => "text",
                ],

                "body" => [
                    "type"        => "textarea",
                ],

                "tags" => [
                    "type"        => "text",
                    "placeholder" => "separate with comma",
                ],
                "id" => [
                    "type"        => "hidden",
                    "value"       => $data["id"],
                ],

                "username" => [
                    "type"        => "hidden",
                    "value"       => $data["username"],
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

        $question = new Question();
        $question->setDb($this->di->get("dbqb"));

        $question->title          = $title;
        $question->body           = $body;
        $question->tags           = $tags;
        $question->ownerid        = $ownerid;
        $question->ownerusername  = $ownerusername;
        $question->save();

        $postid = $question->getSingleQIdByTitle($title);
        $tagsClass = new Tags();
        $posttags = new PostTags();
        $tagsClass->setDb($this->di->get("dbqb"));
        $posttags->setDb($this->di->get("dbqb"));


        if (!$tags) {
            $tags = null;
        } else {
            $tagsArr = [];
            $tagsArr = explode("#", $tags);
            foreach ($tagsArr as $key => $tag) {
                $tag = trim($tag, ",");
                $tag = rtrim($tag, " ");
                $doesTagExist = $tagsClass->checkTagsByName($tag);
                var_dump($doesTagExist);

                //Checks if tag exists and acts accordingly
                if (!$doesTagExist) {
                    $tagsClass->tagname = $tag;
                    $tagsClass->save();
                } else {
                    $tagsClass->tagname = $tag;
                    $tagsClass->id = $tagsClass->id + 1;
                    $tagsClass->save();
                }

                //adds to posttag table
                $posttags->postid = $postid;
                $posttags->tagid = $doesTagExist["id"];
                $posttags->save();
            }
        }

        $this->form->addOutput("Question " .
            $question->title . " was created");
        return true;
    }
}
