<?php

namespace Lioo19\Me;

/**
 * Class for mocking Tags
 * Class only contain methods for checking
 *
 */

class MeMock extends Me
{
    /**
    * Class for mocking request to UserTable
    *
    */


    /**
     * Get all user info by username, including gravatar
     *
     * @param string $password the password to use.
     *
     * @return void
     */
    public function getUserInfo($username)
    {
        // $default = "identicon";
        // $default = "monsterid";
        // $default = "wavatar";

        $default = "robohash";
        $gravUrl = "https://www.gravatar.com/avatar/" .
                md5(strtolower(trim("linn@linn.linn"))) . "?d=" .
                $default . "&s=" . 100;
        $info = array(
            "id" => "1",
            "username" => $username,
            "email" => "linn@linn.linn",
            "created" => "2020-12-10",
            "info" => null,
            "reputation" => null,
            "votes" => null,
            "grav_url" => $gravUrl
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
        $info = array(
            "id"         => $id,
            "username"   => "Linn",
            "password"   => "kjrdnfsidnfkjjs",
            "email"      => "linn@linn.linn",
            "created"    => "2020-12-10",
            "info"       => null,
            "reputation" => null,
            "votes"      => null,
        );
        return $info;
    }
}
