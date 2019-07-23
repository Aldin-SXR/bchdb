<?php

/**
 * Utility class.
 * A collection of utility methods.
 */

namespace BCHDB\Util;

class Util {

    /**
     * Generate random ID.
     * Return a random numeric ID of a specified length.
     * @param int $length Numeric string length.
     * @return string Random numeric ID.
     */
    public static function random_id($length = 6) {
        $keyspace = '0123456789';
        $pieces = [ ];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

    /**
     * Convert object to array.
     * Turn a given object into an array using JSON encoding and decoding.
     * @param object $object Object to be converted.
     * @return array Output array.
     */
    public static function to_array($object) {
        return json_decode(json_encode($object), true);
    }

    /**
     * Resursive array filtering.
     * Recursively filter multi-level and associative arrays to remove empty entries.
     * @param array $array Array to be filtered.
     * @return array Filtered array. 
     */
    public static function array_filter_recursive(&$array) {
        foreach ($array as $key => $item) {
            is_array($item) && !empty($item) && $array[$key] = self::array_filter_recursive($item);
            if (is_array($array) && $array[$key] === NULL) {
                unset($array[$key]);
            }
        }
        return $array;
    } 
}