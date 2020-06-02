<?php

namespace Anchour\Blocks;

use Illuminate\Support\Facades\View;
use Illuminate\Container\Container;

if (!function_exists('app')) {
    function app($abstract = null, $parameters = [], Container $container = null)
    {
        $container = $container ?: Container::getInstance();

        if (!$abstract) {
            return $container;
        }

        return $container->bound($abstract)
            ? $container->makeWith($abstract, $parameters)
            : $container->makeWith("blocks.{$abstract}", $parameters);
    }
}

if (!function_exists('view')) {
    function view($path)
    {
        return View::make($path);
    }
}
