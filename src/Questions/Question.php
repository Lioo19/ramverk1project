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

    /**
     * Get all questions, no answers
     *
     * @return object
     */
    public function getAllQ()
    {
        $all = $this->findAll();

        //delete all with a parentid (answers)
        foreach ($all as $key => $value) {
            if ($value->parentid) {
                unset($all[$key]);
            }
        }

        return $all;
    }

    /**
     * Get all questions
     *
     * @return object
     */
    public function getAll()
    {
        $all = $this->findAll();

        return $all;
    }

    /**
     * Update accepted answer by Id
     *
     *
     * @return void
     */
    public function updateAcceptedById($id, $value)
    {
        //find, sets all variables to current ones
        $this->find("id", $id);
        //updates reputations value with the value we've given
        $this->acceptedanswer = $value;
        //makes the actual update
        $this->update();
    }
}
