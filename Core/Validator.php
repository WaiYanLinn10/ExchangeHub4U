<?php

namespace Core;

class Validator
{
    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
    public static function integer($value, $min = 10, $max = 15)
    {
        return is_numeric($value) && ctype_digit(strval($value)) && strlen($value) >= $min && strlen($value) <= $max;
    }
}
