<?php

namespace Lioo19\Tags;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model.
 */
class PostTags extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Posttags";

    /**
     * Columns in the table.
     * MAKE SURE THAT THESE MATCH DATABASE!!
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $postid;
    public $tagid;

    /**
     * Get Tagids by Postids
     *
     *
     * @param string $id for post
     *
     * @return object
     */
    public function getTagIdsByPostId($id = "")
    {
        $all = $this->findAllWhere("postid = ?", $id);

        return $all;
    }

    /**
     * Get Postids by Tagsid
     * return only Postids in array
     *
     * @param string $id
     *
     * @return object
     */
    public function getPostIdsByTagId($id = "")
    {
        $all = $this->findAllWhere("tagid = ?", $id);
        $res = [];

        foreach ($all as $key => $value) {
            array_push($res, $value->postid);
        }
        return $res;
    }
}
