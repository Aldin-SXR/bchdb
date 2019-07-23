<?php

/**
 * Utility class.
 * A collection of utility methods.
 */

namespace BCHDB;

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

    public static function to_array($object) {
        return json_decode(json_encode($object), true);
    }

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