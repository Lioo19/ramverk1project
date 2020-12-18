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
    protected $tableName = "User";

    /**
     * Columns in the table.
     * MAKE SURE THAT THESE MATCH DATABASE!!
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $username;
    public $email;
    public $password;
    public $created;
    public $info;
    public $reputation;
    public $votes;

    /**
     * Set the password.
     *
     * @param string $password the password to use.
     *
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Verify the acronym and the password, if successful the object contains
     * all details from the database row.
     *
     * @param string $acronym  acronym to check.
     * @param string $password the password to use.
     *
     * @return boolean true if acronym and password matches, else false.
     */
    public function verifyPassword($username, $password)
    {
        $this->find("username", $username);
        return password_verify($password, $this->password);
    }

    /**
     * Set the password.
     *
     * @param string $password the password to use.
     *
     * @return void
     */
    public function getUserInfo($username)
    {
        $this->find("username", $username);
        var_dump($this->created);
        $info = array($this->id, $this->username, $this->email, $this->created, $this->info, $this->reputation, $this->votes);
        return $info;
    }
}
