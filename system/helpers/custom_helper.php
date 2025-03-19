<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Extract CSRF token from raw input
 */
if (!function_exists('extract_csrf_from_raw_input')) {
    function extract_csrf_from_raw_input() {
        $CI =& get_instance(); 

        $raw_input = file_get_contents("php://input");

        parse_str($raw_input, $parsed_input);

        if (isset($parsed_input[$CI->security->get_csrf_token_name()])) {
            $_POST[$CI->security->get_csrf_token_name()] = $parsed_input[$CI->security->get_csrf_token_name()];
        }
    }
}