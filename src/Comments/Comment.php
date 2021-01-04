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


    // WHAT FUNCTIONS ARE NECESSARY?
    // Could addComment be done in an htmlform?
    //addComment - per postid - bör kunna fungera för både q och a
    //getComments - per postid - bör kunna fungera för både q och a

    //is a construct neccessary or helpful?
    // public function __construct($id, $postid, $score, $body, $username)
    // {
    //     $this->id = $id;
    //     $this->postid = $postid;
    //     $this->score = $score;
    //     $this->body = $body;
    //     $this->username = $username;
    //     $this->userid = $userid;
    //     $this->created = $created;
    //     $this->deleted = $deleted;
    // }

    /**
     * Get all users
     * username, reputation, gravatar
     *
     * @param string $password the password to use.
     *
     * @return array
     */
    public function getAllQ()
    {
        $all = $this->findAll();
        $res = [];
        $counter = 0;

        //Only pass username, id and text on
        foreach ($all as $key => $value) {
            var_dump($value);
            //Checks if parentid is null, to sort out answers
            if (!$value->parentid) {
                foreach ($value as $key1 => $value1) {
                    switch ($key1) {
                        case 'id':
                            $res[$counter]["postid"] = $value1;
                            break;
                        case 'deleted':
                            if ($value1) {
                                $res[$counter]["body"] = "Question deleted";
                            }
                            break;
                        case 'body':
                        case 'ownerusername':
                            $res[$counter][$key1] = $value1;
                            break;
                    }
                }
                $counter += 1;
            }
        }
        return $res;
    }

    /**
     * Get single Q by id
     *
     * @param string $id for q
     *
     * @return array | void
     */
    public function getSingleQById($id = "")
    {
        $this->find("id", $id);

        $info = array(
            "id"                => $this->id,
            "body"              => $this->body,
            "created"           => $this->created,
            "deleted"           => $this->deleted,
            "username"          => $this->username,
            "postid"            => $this->postid
        );
        return $info;
    }

    /**
     * Get answers for single Q by Parent id
     *
     * @param string $id for q
     *
     * @return void
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
