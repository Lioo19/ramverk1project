<?php

namespace Lioo19\Tags;

/**
 * Class for mocking Tags
 * Class only contain methods for checking
 *
 */

class PostTagsMock extends PostTags
{
    /**
    * Class for mocking request to UserTable
    *
    */


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
        $all = ["12345"];

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
        $all = ["12345"];

        return $all;
    }
}
