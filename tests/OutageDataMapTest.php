<?php

/**
 * Created by JetBrains PhpStorm.
 * User: stevewagner
 * Date: 10/17/11
 * Time: 9:40 AM
 */

require_once(dirname(__FILE__) . "/../source/Core/OutageDataMap.php");

define("__GROUP_ONE__", "GroupOne");
define("__GROUP_TWO__", "GroupTwo");
define("__GROUP_THREE__", "GroupThree");

class OutageDataMapTest extends PHPUnit_Framework_TestCase
{
    public function testAddItemToHash()
    {
        $dictionary = new OutageDataMap();

        $entry1 = $dictionary->add(__GROUP_ONE__, "0001-01-01 00:00:00", "0001-01-01 01:00:00");
        $entry2 = $dictionary->add(__GROUP_ONE__, "0001-01-01 12:00:00", "0001-01-01 13:00:00");
        $entry3 = $dictionary->add(__GROUP_TWO__, "0001-02-01 00:00:00", "0001-02-01 01:00:00");

        $this->assertEquals(2, sizeof($entry1[0]));
        $this->assertEquals(2, sizeof($entry2[0]));
        $this->assertEquals(2, sizeof($entry3[0]));

        $entry = $dictionary[__GROUP_ONE__];

        $this->assertEquals(2, sizeof($entry));
        $this->assertEquals(1, sizeof($dictionary[__GROUP_TWO__]));
    }

    public function testAllRecordsCanBeRetrievedAsSingleArray()
    {
        $dictionary = $this->buildDictionary();
        $full_array = $dictionary->getAllDataPoints();
        $this->assertEquals(9, sizeof($full_array));
    }

    private function buildDictionary()
    {
        $dictionary = new OutageDataMap();

        $dictionary->add(__GROUP_ONE__, "0001-01-01 00:00:00", "0001-01-01 01:00:00");
        $dictionary->add(__GROUP_ONE__, "0001-01-01 10:00:00", "0001-01-01 11:00:00");
        $dictionary->add(__GROUP_ONE__, "0001-01-01 20:00:00", "0001-01-01 21:00:00");

        $dictionary->add(__GROUP_TWO__, "0001-02-01 00:00:00", "0001-01-01 01:00:00");
        $dictionary->add(__GROUP_TWO__, "0001-02-01 10:00:00", "0001-01-01 11:00:00");
        $dictionary->add(__GROUP_TWO__, "0001-02-01 20:00:00", "0001-01-01 21:00:00");

        $dictionary->add(__GROUP_THREE__, "0001-03-01 00:00:00", "0001-01-01 01:00:00");
        $dictionary->add(__GROUP_THREE__, "0001-03-01 10:00:00", "0001-01-01 11:00:00");
        $dictionary->add(__GROUP_THREE__, "0001-03-01 20:00:00", "0001-01-01 21:00:00");

        return $dictionary;
    }
}
