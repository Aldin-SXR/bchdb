<?php
use PHPUnit\Framework\TestCase;
use BCHDB\Util\Util;

/**
 * Util method tests.
 */

class UtilTest extends TestCase {

    public function testCorrectlyGeneratesARandomId() {
        $random_id = Util::random_id(10);
        $this->assertEquals(10, strlen($random_id));
        $this->assertTrue(is_numeric($random_id));
    }

    public function testCorrectlyConvertsAnObjectIntoAnArray() {
        /* Mock an object */
        $object = new class {
            public $string = 'string';
            public $integer = 42;
            public $array = [
                'double' => 14.53,
                'boolean' => true
            ];
        };

        $array = Util::to_array($object);
        $this->assertEquals([
            'string' => 'string',
            'integer' => 42,
            'array' => [
                'double' => 14.53,
                'boolean' => true
            ]
        ], $array);
    }

    public function testCorrectlyFiltersAnArrayWithEmptyFields() {
        $array = [
            'a' => 1,
            'b' => NULL,
            'c' => [
                'c1' => 2,
                'c2' => NULL,
                'c3' => 3
            ],
            'd' => NULL
        ];

        $filtered = Util::array_filter_recursive($array);
        $this->assertEquals([
            'a' => 1,
            'c' => [
                'c1' => 2,
                'c3' => 3
            ]
        ], $filtered);
    }
}