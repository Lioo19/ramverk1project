<?php

namespace Lioo19\Index;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lioo19\Questions\Question;
use Lioo19\User\User;
use Lioo19\Tags\Tags;


// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class IndexController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * Indexpage for start
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function indexAction(): object
    {
        $page = $this->di->get("page");
        $threeQs = $this->getLatestQ();
        $threeTags = $this->getPopularTags();
        $threeUsers = $this->getActiveUsers();

        $page->add("startpage/startpage", [
            "threeQs"    => $threeQs,
            "threeTags"  => $threeTags,
            "threeUsers" => $threeUsers
        ]);

        return $page->render([
            "title" => "Welcome!",
        ]);
    }

    /**
     * Fetching the latest added Qs (3)
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function getLatestQ()
    {
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));

        $allQs = $question->getAllQ();
        //Gets the latest addition of questions by reversing
        $allQs = array_reverse($allQs);
        //slices array to only three entries
        $threeQs = array_slice($allQs, 0, 3);

        return $threeQs;
    }

    /**
     * Fetching the most popular tags (3)
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function getPopularTags()
    {
        $tags = new Tags();
        $tags->setDb($this->di->get("dbqb"));

        $count = array();
        $allTags = $tags->getAllTags();
        //Picks out Count-value from list of tags
        foreach ($allTags as $key => $row) {
            $count[$key] = $row->count;
        }
        //Sorts array according to count
        array_multisort($count, SORT_DESC, $allTags);

        //slices array to only three entries
        $threeTags = array_slice($allTags, 0, 3);

        return $threeTags;
    }

    /**
     * Fetching the most active users (3)
     * Begin by fetching all Q+As and then retrive ownerid
     * Count most frequesnt ownerids
     * Get those from User Database
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function getActiveUsers()
    {
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));

        $all = $question->getAll();
        $ownerids = array();
        foreach ($all as $key => $value) {
            array_push($ownerids, $value->ownerid);
        }
        $ownerids = array_count_values($ownerids);
        arsort($ownerids);
        $allIdsSorted = array();
        foreach ($ownerids as $key => $value) {
            array_push($allIdsSorted, $key);
        }

        $threeUsers = array();

        if (count($allIdsSorted) < 3) {
            for ($i=0; $i < count($allIdsSorted); $i++) {
                $user = new User();
                $user->setDb($this->di->get("dbqb"));

                $temp = $user->getUserInfoById($allIdsSorted[$i]);
                array_push($threeUsers, $temp);
            }
        } else {
            for ($i=0; $i < 3; $i++) {
                $user = new User();
                $user->setDb($this->di->get("dbqb"));

                $temp = $user->getUserInfoById($allIdsSorted[$i]);
                var_dump($allIdsSorted[$i]);

                array_push($threeUsers, $temp);
            }
        }

        return $threeUsers;
    }
}
