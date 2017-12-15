<?php

class ArrayHelper
{
    /**
     * Get only the values from a multi-dimensional array
     *
     * @param $arr array to get values from
     *
     * @return array
     */
    public static function array_values_multi($arr)
    {
        $result = array();
        self::get_values($result, $arr);
        return $result;
    }

    /**
     * Recursively adds every value in the $arr array to $return
     *
     * @param $return array passed by reference to put all values found
     * @param $arr array to get the values from
     */
    private static function get_values(&$return, $arr)
    {
        foreach ($arr as $index => $value) {
            if (is_array($value)) {
                self::get_values($return, $value);
            } else {
                $return[] = $value;
            }
        }
    }
}