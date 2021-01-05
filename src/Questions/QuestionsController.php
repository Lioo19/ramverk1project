<?php

namespace Lioo19\Questions;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lioo19\Questions\HTMLForm\CreateQuestionForm;
use Lioo19\Questions\HTMLForm\CreateAnswerForm;
use Lioo19\Questions\HTMLForm\CreateCommentForm;
use Lioo19\Comments\Comment;
use Lioo19\Tags\PostTags;
use Lioo19\Tags\Tags;


// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class QuestionsController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * @var $data description
     */
    //private $data;

    /**
     * Shows an overview of available questions
     * Works, get gravatar?
     * Clickable?
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function indexActionGet(): object
    {
        $page = $this->di->get("page");
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));

        $all = $question->getAllQ();

        $page->add("questions/all", [
            "content" => $all,
        ]);

        return $page->render([
            "title" => "A create user page",
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
        $tags       = new Tags();

        $question->setDb($this->di->get("dbqb"));
        $comment->setDb($this->di->get("dbqb"));
        $posttags->setDb($this->di->get("dbqb"));
        $tags->setDb($this->di->get("dbqb"));
        $id = $request->getGet("id", null);

        $answers        = $question->getAnswersByParentId($id);
        $question       = $question->getSingleQById($id);
        $posttagsForQ   = $posttags->getTagIdsByPostId($id);
        $allTags    = [];

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

        $login = $session->get("login");
        if ($login) {
            $form = new CreateAnswerForm($this->di);
            $form->check();

            $page->add("questions/singlewanswer", [
                "newAnswer" => $form->getHTML(),
                "question"  => $question,
                "answers"   => $answers,
                "comments"  => $comments,
                "tags"      => $allTags
            ]);

            return $page->render([
                "title" => "A login page",
            ]);
        }

        $page->add("questions/singlewoutanswer", [
            "question" => $question,
            "answers" => $answers
        ]);

        return $page->render([
            "title" => "Q",
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
                "title" => "A login page",
            ]);
        }

        $page->add("questions/singlewoutanswer", [
            "question" => $question,
            "answers" => $answers
        ]);

        return $page->render([
            "title" => "Q",
        ]);
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
                "title" => "A login page",
            ]);
        }

        $page->add("questions/noaccess", [
            "content" => "blepp",
        ]);

        return $page->render([
            "title" => "A login page",
        ]);
    }
}
