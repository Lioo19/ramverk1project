<?php

namespace Lioo19\Questions;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model.
 */
class Question extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Posts";

    /**
     * Columns in the table.
     * MAKE SURE THAT THESE MATCH DATABASE!!
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $title;
    public $body;
    public $created;
    public $deleted;
    public $tags;
    public $ownerid;
    public $ownerusername;
    public $parentid;
    public $acceptedanswer;



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
        // $default = "identicon";
        // $default = "monsterid";
        // $default = "wavatar";
        $default = "robohash";

        //Only pass username, id and text on
        foreach ($all as $key => $value) {
            // var_dump($value);
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
                        case 'title':
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
            "title"             => $this->title,
            "body"              => $this->body,
            "created"           => $this->created,
            "deleted"           => $this->deleted,
            "tags"              => $this->tags,
            "ownerusername"     => $this->ownerusername,
            "parentid"          => $this->parentid,
            "acceptedanswer"    => $this->acceptedanswer
        );
        return $info;
    }

    /**
     * Get single Q-id by title
     *
     * @param string $title for q
     *
     * @return array | void
     */
    public function getSingleQIdByTitle($title = "")
    {
        $this->find("title", $title);

        return $this->id;
    }

    /**
     * Get answers for single Q by Parent id
     *
     * @param string $id for q
     *
     * @return void
     */
    public function getAnswersByParentId($id = "")
    {
        $all = $this->findAllWhere("parentid = ?", $id);

        return $all;
    }

    /**
     * Get all questions connected to certain user
     *
     * @param string $ownerusername
     *
     * @return object
     */
    public function getQsByUsername($username = "")
    {
        $all = $this->findAllWhere("ownerusername = ?", $username);

        return $all;
    }
}
