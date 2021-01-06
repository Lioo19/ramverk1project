<?php

namespace Lioo19\Tags;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model.
 */
class Tags extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Tags";

    /**
     * Columns in the table.
     * MAKE SURE THAT THESE MATCH DATABASE!!
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $tagname;
    public $count;

    /**
     * Get all tags
     * username, reputation, gravatar
     *
     * @param string $password the password to use.
     *
     * @return array
     */
    public function getAllTags()
    {
        $all = $this->findAll();
        return $all;
    }

    /**
     * check if tag exists
     *
     * @param string $password the password to use.
     *
     * @return array
     */
    public function checkTagsByName($tagname = "")
    {
        $this->find("tagname", $tagname);

        $info = array(
            "id"                => $this->id,
            "tagname"           => $this->tagname,
            "count"             => $this->count
        );

        return $info;
    }

    /**
     * Get tagname by id
     *
     * @param string $id
     *
     * @return array
     */
    public function getNameById($id = "")
    {
        $this->find("id", $id);

        return $this->tagname;
    }

    /**
     * get count by searching for name
     *
     * @param string $password the password to use.
     *
     * @return array
     */
    public function getCountByName($tagname = "")
    {
        $this->find("tagname", $tagname);

        return $this->count;
    }

    /**
     * create new tag
     *
     * @param string $password the password to use.
     *
     * @return array
     */
    public function createTag($tagname = "")
    {
        $this->find("tagname", $tagname);

        $info = array(
            "id"                => $this->id,
            "tagname"           => $this->tagname,
            "count"             => $this->count
        );

        return $info;
    }
}
