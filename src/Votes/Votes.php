<?php

namespace Lioo19\Votes;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model.
 */
class Votes extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Votes";

    /**
     * Columns in the table.
     * MAKE SURE THAT THESE MATCH DATABASE!!
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $userid;
    public $postid;
    public $commentid;
    public $count;

    /**
     * Create new entry in votes-table
     *
     *
     * @param string $postcommentid & $userid
     *
     * @return void
     */
    public function createVote($postcommentid, $userid, $type)
    {
        if ($type === "post") {
            $this->postid = $postcommentid;
        } else {
            $this->commentid = $postcommentid;
        }
        $this->userid = $userid;
        $this->count = 0;

        $this->create();
    }

    /**
     * Updates the count of the votes-table
     *
     *
     * @param string $postcommentid, $type, $value
     *
     * @return void
     */
    public function updateVote($postcommentid, $type, $value)
    {
        $this->findWhere($type . "id = ?", intval($postcommentid));
        //updates reputations value with the value we've given
        $this->count = $this->count + $value;
        //makes the actual update
        $this->update();
    }

    /**
     * Get all votes in table
     *
     *
     * @param string $password the password to use.
     *
     * @return array
     */
    public function getAllVotes()
    {
        $all = $this->findAll();
        return $all;
    }

    /** Get Votes for certain ID
     * Returns one value
     *
     * @param string $id for post
     *
     * @return object
     */
    public function getCountByPostorCommentId($id, $type)
    {
        $all = $this->findAllWhere($type . "id = ?", $id);
        // var_dump($all);
        return $all[0]->count;
    }

    /**
     * Get all counts for Userid
     * return only counts in array
     * Would I rather get the sum?
     *
     * @param string $id
     *
     * @return object
     */
    public function getCountsByUserId($id = "")
    {
        $all = $this->findAllWhere("userid = ?", $id);
        $res = [];

        foreach ($all as $key => $value) {
            array_push($res, $value->count);
        }
        return $res;
    }
}
