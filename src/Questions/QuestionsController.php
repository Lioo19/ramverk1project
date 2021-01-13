<?php

namespace Lioo19\Questions;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lioo19\Questions\HTMLForm\CreateQuestionForm;
use Lioo19\Questions\HTMLForm\CreateAnswerForm;
use Lioo19\Questions\HTMLForm\CreateCommentForm;
use Lioo19\Comments\Comment;
use Lioo19\Tags\PostTags;
use Lioo19\Votes\Votes;
use Lioo19\Tags\Tags;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class QuestionsController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * Shows an overview of available questions
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
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));

        $all = $question->getAllQ();

        $page->add("questions/all", [
            "content" => $all,
        ]);

        return $page->render([
            "title" => "Questions",
        ]);
    }

    /**
     * Post-route for individual Q-page
     *
     * @return object
     */
    public function indexActionPost(): object
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");

        $id = $request->getGet("id", null);

        if ($id) {
            return $response->redirect("q/showq?id=$id");
        } else {
            return $response->redirect("q");
        }
    }

    /**
     * Show single Q
     *
     * @return object
     */
    public function showQAction(): object
    {
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $session = $this->di->get("session");

        $question   = new Question();
        $comment    = new Comment();
        $posttags   = new PostTags();
        $votes      = new Votes();
        $tags       = new Tags();

        $question->setDb($this->di->get("dbqb"));
        $comment->setDb($this->di->get("dbqb"));
        $posttags->setDb($this->di->get("dbqb"));
        $votes->setDb($this->di->get("dbqb"));
        $tags->setDb($this->di->get("dbqb"));
        $id = $request->getGet("id", null);

        $answers        = $question->getAnswersByParentId($id);
        $question       = $question->getSingleQById($id);
        $posttagsForQ   = $posttags->getTagIdsByPostId($id);
        $voteCount      = $votes->getCountByPostorCommentId($id, "post");
        $allTags        = [];

        foreach ($posttagsForQ as $key => $value) {
            $temp = $tags->getNameById($value->tagid);
            array_push($allTags, [$temp, $value->tagid]);
        }

        $comments = array();
        foreach ($answers as $key => $value) {
            $temp = $comment->getCommentsByParentId($value->id);
            $comments[$value->id] = $temp;
        }
        $comments[$id] = $comment->getCommentsByParentId($id);

        //loop to add votes to answers
        foreach ($answers as $key => $value) {
            $votesA = new Votes();
            $votesA->setDb($this->di->get("dbqb"));
            $countForA = $votesA->getCountByPostorCommentId($value->id, "post");
            $answers[$key]->votes = $countForA;
        }

        //loop to add votes to comments
        foreach ($comments as $key => $value) {
            $counted = count($value);
            if ($counted > 0) {
                $votesC = new Votes();
                $votesC->setDb($this->di->get("dbqb"));
                $countForC = $votesC->getCountByPostorCommentId($value[0]->id, "comment");
                $comments[$key][0]->votes = $countForC;
            }
        }

        $login = $session->get("login");
        if ($login) {
            $form = new CreateAnswerForm($this->di);
            $form->check();

            // Renders page with answering-form
            $page->add("questions/singlewform", [
                "newAnswer" => $form->getHTML(),
                "question"  => $question,
                "answers"   => $answers,
                "comments"  => $comments,
                "tags"      => $allTags,
                "votesForQ" => $voteCount,
                "loggedin"  => $session->get("user")
            ]);

            return $page->render([
                "title" => "View Q",
            ]);
        }

        // Renders page with answering-form
        $page->add("questions/singlewoutform", [
            "question"  => $question,
            "answers"   => $answers,
            "comments"  => $comments,
            "tags"      => $allTags,
            "votesForQ" => $voteCount,
            "loggedin"  => $session->get("user")
        ]);

        return $page->render([
            "title" => "View Q",
        ]);
    }

    /**
     * Create a new comment for a specific post
     *
     * @return object
     */
    public function commentOnAction(): object
    {
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $session = $this->di->get("session");
        $response = $this->di->get("response");

        $question = new Question();
        $question->setDb($this->di->get("dbqb"));

        $id = $request->getGet("id", null);
        $question = $question->getSingleQById($id);

        $login = $session->get("login");
        if ($login) {
            $form = new CreateCommentForm($this->di);
            $form->check();

            $page->add("questions/singleqoraforcomment", [
                "newComment" => $form->getHTML(),
                "question" => $question,
            ]);

            return $page->render([
                "title" => "New comment",
            ]);
        }
        //If not logged in, return to Q
        return $response->redirect("q/showq?id=$id");
    }


    /**
     * Creates a question-form if logged in
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function askAction(): object
    {
        $page = $this->di->get("page");
        $session = $this->di->get("session");

        $login = $session->get("login");
        if ($login) {
            $form = new CreateQuestionForm($this->di);
            $form->check();

            $page->add("questions/ask", [
                "content" => $form->getHTML(),
            ]);

            return $page->render([
                "title" => "Ask",
            ]);
        }

        $page->add("questions/noaccess", [
            "content" => "none",
        ]);

        return $page->render([
            "title" => "No Access to this page",
        ]);
    }

    /**
     * Route for accepting an answer as an accepted answer
     *
     * @return object
     */
    public function acceptAnswerAction(): object
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");

        $answer = new Question();
        $answer->setDb($this->di->get("dbqb"));

        $id = $request->getGet("id", null);
        //setting params for answer
        $allinfo = $answer->getSingleQById($id);
        $parentid = $allinfo["parentid"];
        $answer = $answer->updateAcceptedById($id, "true");
        //Redirect back to Q
        return $response->redirect("q/showq?id=$parentid");
    }

    /**
     * Route for accepting an answer as an accepted answer
     *
     * @return object
     */
    public function unacceptAnswerAction(): object
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");

        $answer = new Question();
        $answer->setDb($this->di->get("dbqb"));

        $id = $request->getGet("id", null);
        //setting params for answer
        $allinfo = $answer->getSingleQById($id);
        $parentid = $allinfo["parentid"];
        $answer = $answer->updateAcceptedById($id, "false");
        //Redirect back to Q
        return $response->redirect("q/showq?id=$parentid");
    }

    /**
     * Route for updating vote-value for q, a
     *
     * @return object
     */
    public function updateVoteAction(): object
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");

        $vote = new Votes();
        $vote->setDb($this->di->get("dbqb"));

        $id     = $request->getGet("id", null);
        $value  = $request->getGet("value", null);
        $type   = $request->getGet("type", null);

        //updating the vote with the new value (works for any value)

        if ($type === "qcomment") {
            $vote = $vote->updateVote($id, "comment", $value);
            $comment = new Comment();
            $comment->setDb($this->di->get("dbqb"));
            $allinfo = $comment->getSingleCById($id);
            $postid = $allinfo["postid"];
            return $response->redirect("q/showq?id=$postid");
        } elseif ($type === "anscomment") {
            $vote = $vote->updateVote($id, "comment", $value);
            $comment = new Comment();
            $answer = new Question();
            $answer->setDb($this->di->get("dbqb"));
            $comment->setDb($this->di->get("dbqb"));

            $allinfo = $comment->getSingleCById($id);
            //this is now the commentID, we need parentid for correct reroute
            $postid = $allinfo["postid"];
            //get parentid from Post-table
            $allinfo = $answer->getSingleQById($postid);
            $parentid = $allinfo["parentid"];
            return $response->redirect("q/showq?id=$parentid");
        } elseif ($type === "answer") {
            $vote = $vote->updateVote($id, "post", $value);
            $answer = new Question();
            $answer->setDb($this->di->get("dbqb"));
            $allinfo = $answer->getSingleQById($id);
            $parentid = $allinfo["parentid"];
            return $response->redirect("q/showq?id=$parentid");
        }
        $vote = $vote->updateVote($id, "post", $value);
        //Redirect back to Q
        return $response->redirect("q/showq?id=$id");
    }
}
