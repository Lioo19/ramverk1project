<?php

namespace Lioo19\Tags;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lioo19\Tags\HTMLForm\UserLoginForm;
use Lioo19\Tags\HTMLForm\CreateUserForm;
use Lioo19\Questions\Question;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class TagsController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * Shows an overview of all tags in use
     * should be Clickable and lead to page displaying posts under each tag
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function indexAction(): object
    {
        $page = $this->di->get("page");
        $tags = new Tags();
        $tags->setDb($this->di->get("dbqb"));

        $all = $tags->getAllTags();

        $page->add("tags/tags", [
            "content" => $all,
        ]);

        return $page->render([
            "title" => "Tags",
        ]);
    }

    /**
     * Individual page for each tag
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function showSingleAction(): object
    {
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $id = $request->getGet("id", null);
        $tagname = $request->getGet("name", null);

        //har idt för taggen, hämta alla postid från posttag
        $posttags = new PostTags();
        $posttags->setDb($this->di->get("dbqb"));

        $postids = $posttags->getPostIdsByTagId($id);
        $questions = [];

        foreach ($postids as $key => $postid) {
            $question = new Question();
            $question->setDb($this->di->get("dbqb"));

            array_push($questions, $question->getSingleQById($postid));
        }

        $page->add("tags/singletag", [
            "questions" => $questions,
            "tagname"   => $tagname
        ]);


        return $page->render([
            "title" => "Questions with " . $tagname,
        ]);
    }
}
