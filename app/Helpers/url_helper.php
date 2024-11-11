<?php

if (!function_exists('base_url')) {
    function base_url($path = '')
    {
        global $baseURL;
        return rtrim($baseURL, '/') . '/' . ltrim($path, '/');
    }
}
