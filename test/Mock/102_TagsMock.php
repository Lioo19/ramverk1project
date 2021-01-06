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
    public function getAllTags()
    {
        $info = array("1", "Linn", "linn@linn.linn", "2020-12-10", null, null, null);
        return $info;
    }
}
