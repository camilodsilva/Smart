<?php

namespace Smart\Rosolvers;

class HttpResolver
{
    public static function redirect($location)
    {
        $location = sprintf('Location: %s', $location);
        header($location);
    }
}