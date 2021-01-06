<?php

namespace Lioo19\Tags;

/**
 * Class for mocking Tags
 * Class only contain methods for checking
 *
 */

class TagsMock extends Tags
{
    /**
    * Class for mocking request to UserTable
    *
    */
    /**
     * GetUserInfo by username
     *
     * @param string $password the password to use.
     *
     * @return void
     */
    public function getUserInfo($username)
    {
        $info = array("1", "Linn", "linn@linn.linn", "2020-12-10", null, null, null);
        return $info;
    }

    /**
     * GetUserInfo by id
     *
     * @param string $id
     *
     * @return array associative
     */
    public function getUserInfoById($id)
    {
        $default = "robohash";
        $info = array();

        $info["id"] = $id;
        $info["username"] = "Linn";
        $info["created"] = "2020-12-10";
        $info["info"] = null;
        $info["reputation"] = null;
        $info["votes"] = null;
        $info["gravatar"] = "https://www.gravatar.com/avatar/" .
                            md5(strtolower(trim("linn@linn.linn"))) . "?d=" .
                            $default . "&s=" . 100;
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
        $info = array("1", "Linn", "linn@linn.linn", "2020-12-10", null, null, null);
        return $info;
    }
}
