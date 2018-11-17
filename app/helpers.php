<?php

if (!function_exists('view')) {
    function view($view = 'index')
    {
        require_once __DIR__ . "/../views/{$view}.php";
    }
}

if (!function_exists('partialView')) {
    function partialView($view = 'index')
    {
        require_once __DIR__ . "/../views/partials/{$view}.php";
    }
}

if (!function_exists('redirect')) {
    function redirect($location = '/')
    {
        header("Location: {$location}");
        exit();
    }
}
