<?php

use Carbon\Carbon;

/**
 * Преобразование из строки в дату
 */
if (!function_exists('parse_date')) {
    function parse_date($value)
    {
        return !empty($value) ? Carbon::parse($value) : null;
    }
}
