<?php

namespace AC\Helpers;

class FormHelper
{
    /**
     * Check if checkbox is selected and output checked else output an empty string.
     *
     * @param string $haystack
     * @param $resource
     *
     * @return string
     */
    public function checkboxIsActive($haystack = '', $resource)
    {
        return (old($haystack) === '1') || ($resource && $resource->$haystack === 1) ? 'checked' : '';
    }

    /**
     * Check if option is selected and output selected else output an empty string.
     *
     * @param array $array
     *
     * @return string
     */
    public function optionIsSelected(array $array)
    {
        $resource = $array[0];
        $haystack = $array[1];
        $currentResource = isset($array[2]) ? $array[2] : '';

        return (old($haystack) === $resource->id) || ($currentResource && $currentResource->$haystack === $resource->id)
            ? 'selected' : '';
    }
}
