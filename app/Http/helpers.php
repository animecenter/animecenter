<?php

if (!function_exists('get_first_value_in_array')) {

    /**
     * Get first value in array that is not empty.
     *
     * @param array $values
     *
     * @return string
     */
    function get_first_value_in_array(array $values)
    {
        return current(array_filter($values));
    }
}

if (!function_exists('checkbox_is_active')) {

    /**
     * Check if checkbox is selected and output checked else output an empty string.
     *
     * @param string $haystack
     * @param $resource
     *
     * @return string
     */
    function checkbox_is_active($haystack = '', $resource)
    {
        return (old($haystack) === '1') || ($resource && $resource->$haystack === 1) ? 'checked' : '';
    }
}

if (!function_exists('option_is_selected')) {

    /**
     * Check if option is selected and output selected else output an empty string.
     *
     * @param array $array
     *
     * @return string
     */
    function option_is_selected(array $array)
    {
        $resource = $array[0];
        $haystack = $array[1];
        $currentResource = isset($array[2]) ? $array[2] : '';

        return (old($haystack) === $resource->id) || ($currentResource && $currentResource->$haystack === $resource->id)
            ? 'selected' : '';
    }
}

if (!function_exists('check_if_string_contains_a_value_from_array')) {

    /**
     * Return true if the string passed contains a value equal to any value from array.
     *
     * @param string $string
     * @param array $values
     *
     * @return string
     */
    function check_if_string_contains_a_value_from_array($string = '', array $values)
    {
        foreach($values as $value) {
            if (strpos($string, $value) !== false) {
                return true;
            }
        }
        return false;
    }
}
