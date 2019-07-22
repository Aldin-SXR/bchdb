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
}