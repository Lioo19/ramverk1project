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
     * Get answers for single Q by Parent id
     *
     * @param string $id for q
     *
     * @return void
     */
    public function getTagIdsByPostId($id = "")
    {
        $all = $this->findAllWhere("postid = ?", $id);

        $res = [];
        $counter = 0;

        //Should probably work, if all is passed on, remove switch-statement
        foreach ($all as $key => $value) {
            foreach ($value as $key1 => $value1) {
                switch ($key1) {
                    default:
                        $res[$counter][$key1] = $value1;
                        break;
                }
            }
            $counter += 1;
        }
        // var_dump($res);
        return $res;
    }

}
