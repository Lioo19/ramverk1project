<?php
namespace Lioo19\Me;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model.
 */
class Me extends ActiveRecordModel
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
     * Get all user info by username, including gravatar
     *
     * @param string $password the password to use.
     *
     * @return void
     */
    public function getUserInfo($username)
    {
        $this->find("username", $username);
        // $default = "identicon";
        // $default = "monsterid";
        // $default = "wavatar";
        $default = "robohash";
        $grav_url = "https://www.gravatar.com/avatar/" .
                md5( strtolower( trim( $this->email ) ) ) . "?d=" .
                $default . "&s=" . 100;
        $info = array(
            "id" => $this->id,
            "username" => $this->username,
            "email" => $this->email,
            "created" => $this->created,
            "info" => $this->info,
            "reputation" => $this->reputation,
            "votes" => $this->votes,
            "grav_url" => $grav_url
        );
        return $info;
    }

    /**
     * Get all user info by id
     *
     * @param string $password the password to use.
     *
     * @return void
     */
    public function getUserInfoById($id)
    {
        $this->find("id", $id);
        $info = array(
            "id"         => $this->id,
            "username"   => $this->username,
            "password"   => $this->password,
            "email"      => $this->email,
            "created"    => $this->created,
            "info"       => $this->info,
            "reputation" => $this->reputation,
            "votes"      => $this->votes,
        );
        return $info;
    }
}
