<?php
namespace Lioo19\User;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model.
 */
class User extends ActiveRecordModel
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
     * GetUserInfo by username
     *
     * @param string $password the password to use.
     *
     * @return void
     */
    public function getUserInfo($username)
    {
        $this->find("username", $username);
        $info = array($this->id, $this->username, $this->email, $this->created, $this->info, $this->reputation, $this->votes);
        return $info;
    }


    /**
     * Get all users
     * username, reputation, gravatar
     *
     * @param string $password the password to use.
     *
     * @return void
     */
    public function getAllUsers()
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
                if ($key1 === "email") {
                    $grav_url = "https://www.gravatar.com/avatar/" .
                            md5( strtolower( trim( $value1 ) ) ) . "?d=" .
                            $default . "&s=" . 100;
                    $res[$counter]["gravatar"] = $grav_url;
                } elseif ($key1 === "username" || $key1 === "reputation" || $key1 === "info") {
                    $res[$counter][$key1] = $value1;
                }
            }
            $counter += 1;

        }
        // $info = array($this->id, $this->username, $this->email, $this->created, $this->info, $this->reputation, $this->votes);
        return $res;
    }
}
