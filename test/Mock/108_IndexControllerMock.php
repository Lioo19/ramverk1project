<?php

namespace Lioo19\Index;

use Lioo19\Index\IndexMock;
use Lioo19\Questions\QuestionMock;
use Lioo19\Questions\TagsMock;
use Lioo19\UserMock;

/**
 * Class for mocking GeoController
 * Class only contain methods for checking
 *
 */

class IndexControllerMock extends IndexController
{


    /**
     * Fetching the latest added Qs (3)
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function getLatestQ()
    {
        $question = new QuestionMock();
        $question->setDb($this->di->get("dbqb"));

        $allQs = $question->getAllQ();
        //Gets the latest addition of questions by reversing
        $allQs = array_reverse($allQs);
        //slices array to only three entries
        $threeQs = array_slice($allQs, 0, 4);

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
        $tags = new TagsMock();
        $tags->setDb($this->di->get("dbqb"));

        $counter = array();
        $allTags = $tags->getAllTags();
        //Picks out Count-value from list of tags
        foreach ($allTags as $key => $row) {
            $counter[$key] = $row->count;
        }
        //Sorts array according to count
        array_multisort($counter, SORT_DESC, $allTags);

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
        $question = new QuestionMock();
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
        $counted = count($allIdsSorted);

        if ($counted < 3) {
            for ($i = 0; $i < ($counted); $i++) {
                $user = new UserMock();
                $user->setDb($this->di->get("dbqb"));

                $temp = $user->getUserInfoById($allIdsSorted[$i]);
                array_push($threeUsers, $temp);
            }
        } else {
            for ($i = 0; $i < 3; $i++) {
                $user = new UserMock();
                $user->setDb($this->di->get("dbqb"));

                $temp = $user->getUserInfoById($allIdsSorted[$i]);

                array_push($threeUsers, $temp);
            }
        }

        return $threeUsers;
    }
}
