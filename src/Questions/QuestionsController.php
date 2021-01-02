<?php

namespace Lioo19\Questions;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lioo19\Questions\HTMLForm\CreateQuestionForm;
use Lioo19\Questions\HTMLForm\CreateAnswerForm;

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



    // /**
    //  * The initialize method is optional and will always be called before the
    //  * target method/action. This is a convienient method where you could
    //  * setup internal properties that are commonly used by several methods.
    //  *
    //  * @return void
    //  */
    // public function initialize() : void
    // {
    //     ;
    // }



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

        $question = new Question();
        $question->setDb($this->di->get("dbqb"));

        $id = $request->getGet("id", null);

        //WORKS, but need handling when added data
        //varför får jag fel om jag lägger dem i den andra ordningen?
        $answers  = $question->getAnswersByParentId($id);
        $question = $question->getSingleQById($id);

        // var_dump($question);
        $login = $session->get("login");
        if ($login) {
            $form = new CreateAnswerForm($this->di);
            $form->check();

            $page->add("questions/singlewanswer", [
                "newAnswer" => $form->getHTML(),
                "question" => $question,
                "answers" => $answers
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



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function tagsAction(): object
    {
        $page = $this->di->get("page");
        $form = new CreateUserForm($this->di);
        $form->check();

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "A create user page",
        ]);
    }
}
