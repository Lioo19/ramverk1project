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
                    "placeholder" => "#tag1, #tag2",
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

        $this->createTags($tags, $postid);

        $this->form->addOutput("Question " .
            $question->title . " was created");
        return true;
    }

    /**
     * Helper-function for separating and creating tags
     *
     *
     */
    public function createTags($tags, $postid)
    {

        if (!$tags) {
            $tags = null;
        } else {
            $tagsArr = explode(" ", $tags);
            foreach ($tagsArr as $key => $tag) {
                $tagsClass = new Tags();
                $posttags = new PostTags();
                $tagsClass->setDb($this->di->get("dbqb"));
                $posttags->setDb($this->di->get("dbqb"));

                $tag = trim($tag, ", #");
                $doesTagExist = $tagsClass->checkTagsByName($tag);

                //Checks if tag exists and acts accordingly
                if (!$tagsClass->tagname) {
                    $tagsClass->tagname = $tag;
                    $tagsClass->count = 1;
                    $tagsClass->save();
                    $tagid = $tagsClass->checkTagsByName($tags);
                    $tagid = $tagid["id"];

                    //adds to posttag table
                    $posttags->postid = $postid;
                    $posttags->tagid = $tagid;

                    $posttags->save();
                } else {
                    $tagsClass->tagname = $tag;
                    $tagsClass->count = $doesTagExist["count"] + 1;
                    $tagsClass->save();
                    $tagid = $tagsClass->checkTagsByName($tags);
                    $tagid = $tagid["id"];

                    //adds to posttag table
                    $posttags->postid = $postid;
                    $posttags->tagid = $tagid;

                    $posttags->save();
                }
            }
        }
    }
}
