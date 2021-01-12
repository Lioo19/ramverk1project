<?php

namespace Lioo19\Questions\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Lioo19\Me\Me;
use Lioo19\Votes\Votes;
use Lioo19\Comments\Comment;
use Lioo19\Questions\Question;
use Lioo19\MyTextFilter\MyTextFilter;

/**
* formModel for creating a comment
 */
class CreateCommentForm extends FormModel
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
        // $question = $qObj->getSingleQById($parentid);

        $counter = 0;
        $countedAns = count($answers);

        for ($i = 0; $i < $countedAns; $i++) {
            $counter += 1;
        }

        $counter += 1;

        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "New Comment"
            ],
            [
                "body" => [
                    "type"        => "textarea",
                    "placeholder" => "use markdown to style your comment"
                ],

                "username" => [
                    "type"        => "hidden",
                    "value"       => $owner["username"],
                ],
                "postid" => [
                    "type"        => "hidden",
                    "value"       => $parentid,
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Comment",
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
        $filter = new MyTextFilter();

        $body          = $filter->parse($this->form->value("body"), ["markdown"]);
        $username      = $this->form->value("username");
        $postid        = $this->form->value("postid");

        $comment = new Comment();
        $comment->setDb($this->di->get("dbqb"));

        $comment->body           = $body;
        $comment->username       = $username;
        $comment->postid         = $postid;

        $comment->save();

        $meObj = new Me();
        $meObj->setDb($this->di->get("dbqb"));
        //comments give one point to rep
        $meObj->updateReputationByUsername($username, 1);

        $postid = $question->getSingleQIdByTitle($title); //is this really neccessary? 

        //Create entry for voting
        $votes = new Votes();
        $votes->setDb($this->di->get("dbqb"));

        $votes->createVote($postid, $username, "comment");

        $this->form->addOutput("Comment added");
        return true;
    }
}
