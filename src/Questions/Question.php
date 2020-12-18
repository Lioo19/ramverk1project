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
     * @return void
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

        //Only pass username and reputation on
        foreach ($all as $key => $value) {
            foreach ($value as $key1 => $value1) {
                switch ($key1) {
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
        // $info = array($this->id, $this->username, $this->email, $this->created, $this->info, $this->reputation, $this->votes);
        return $res;
    }
}
