<?php

namespace AC\Helpers;

class ArrayHelper
{

    /**
     * Get first value in array that is not empty.
     *
     * @param array $values
     *
     * @return string
     */
    public function get_first_value_in_array(array $values)
    {
        return current(array_filter($values));
    }

    /**
     * Return true if the string passed contains a value equal to any value from array.
     *
     * @param string $string
     * @param array  $values
     *
     * @return string
     */
    public function check_if_string_contains_a_value_from_array($string = '', array $values)
    {
        foreach ($values as $value) {
            if (strpos($string, $value) !== false) {
                return true;
            }
        }

        return false;
    }
}
