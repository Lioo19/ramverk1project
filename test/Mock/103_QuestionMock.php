<?php

namespace Lioo19\Questions;

/**
 * Class for mocking Tags
 * Class only contain methods for checking
 *
 */

class QuestionMock extends Question
{
    /**
    * Class for mocking request to UserTable
    *
    */

    /**
     * Get single Q by id
     *
     * @param string $id for q
     *
     * @return array | void
     */
    public function getSingleQById($id = "")
    {
        $info = array(
            "id"                => $id,
            "title"             => "harry potter",
            "body"              => "harry potter",
            "created"           => "2020-12-10",
            "deleted"           => null,
            "tags"              => "harry",
            "ownerusername"     => "Linn",
            "parentid"          => "1",
            "acceptedanswer"    => null
        );
        return $info;
    }

    /**
     * Get all questions, no answers
     *
     * @return object
     */
    public function getAllQ()
    {
        $info = array(
            "id"                => "1",
            "title"             => "harry potter",
            "body"              => "harry potter",
            "created"           => "2020-12-10",
            "deleted"           => null,
            "tags"              => "harry",
            "ownerusername"     => "Linn",
            "parentid"          => "1",
            "acceptedanswer"    => null
        );
        return $info;
    }

    /**
     * Get all questions
     *
     * @return object
     */
    public function getAll()
    {
        $info = array(
            "id"                => "1",
            "title"             => "harry potter",
            "body"              => "harry potter",
            "created"           => "2020-12-10",
            "deleted"           => null,
            "tags"              => "harry",
            "ownerusername"     => "Linn",
            "parentid"          => "1",
            "acceptedanswer"    => null
        );
        return $info;
    }
}
