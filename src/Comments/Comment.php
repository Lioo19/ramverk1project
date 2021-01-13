<?php

namespace Lioo19\Comments;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model.
 */
class Comment extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Comments";

    /**
     * Columns in the table.
     * MAKE SURE THAT THESE MATCH DATABASE!!
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $postid;
    public $score;
    public $body;
    public $created;
    public $deleted;
    public $username;
    public $userid;

    /**
     * Get single C by id
     *
     * @param string $id for c
     *
     * @return array | void
     */
    public function getSingleCById($id = "")
    {
        $this->find("id", $id);

        $info = array(
            "id"                => $this->id,
            "postid"            => $this->postid,
            "score"             => $this->score,
            "body"              => $this->body,
            "created"           => $this->created,
            "deleted"           => $this->deleted,
            "username"          => $this->username,
            "userid"            => $this->userid
        );
        return $info;
    }

    /**
     * Get answers for single Q by Parent id
     *
     * @param string $id for q
     *
     * @return array
     */
    public function getCommentsByParentId($id = "")
    {
        $all = $this->findAllWhere("postid = ?", $id);
        return $all;
    }

    /**
     * Get all comments made by user
     *
     * @param string $username
     *
     * @return void
     */
    public function getCommentsByUsername($username = "")
    {
        $all = $this->findAllWhere("username = ?", $username);

        return $all;
    }
}
