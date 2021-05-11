<?php

namespace App\Core;

use \ReflectionFunction;
use \ReflectionClass;

class Controller
{
    public function parse($name)
    {
        return function ($parameters) use ($name) {
            $reflectionClass = new ReflectionClass($this);
            $reflection = $reflectionClass->getMethod($name);
            $desiredParameters = $reflection->getParameters();

            $arguments = [];

            foreach ($desiredParameters as $parameter) {
                array_push(
                    $arguments,
                    isset($parameters[$parameter->getName()]) ? $parameters[$parameter->getName()] : null
                );
            }

            call_user_func_array($reflection->getClosure($this), $arguments);
        };
    }
}
