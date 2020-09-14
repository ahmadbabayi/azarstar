<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function filter_url($string) {
    trim($string);
    $string = str_replace('(', ' - ', $string);
    $string = str_replace(')', '', $string);
        return $string;
}
