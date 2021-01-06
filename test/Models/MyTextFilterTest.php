<?php

namespace Lioo19\MyTextFilter;

use PHPUnit\Framework\TestCase;
use Lioo19\MyTextFilter\MyTextFilter;

/**
 * Test the SampleController.
 */
class MyTextFilterTest extends TestCase
{
    /**
     * Test checking that getLastRoll returns int
     *
     */
    public function testTextFilter()
    {
        $filter = new MyTextFilter();

        $res = $filter->parse("*hejsan*", ["markdown"]);
        $this->assertIsString($res);

        $res = $filter->parse("hejsan", ["bbcode"]);
        $this->assertIsString($res);
    }
}
