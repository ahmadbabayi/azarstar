<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function latex_tipa($string) {
    trim($string);
    $string = str_replace('ɸ', 'F', $string);
    $string = str_replace('θ', 'T', $string);
    $string = str_replace('ɪ', 'I', $string);
    $string = str_replace('ə', '@', $string);
    $string = str_replace('ʃ', 'S', $string);
    $string = str_replace('ɛ', 'E', $string);
    $string = str_replace('ɔ', 'O', $string);
    $string = str_replace('ŋ', 'N', $string);
    $string = str_replace('ʒ', 'Z', $string);
    $string = str_replace('ʒ', 'Z', $string);
    return $string;
}