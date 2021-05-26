<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\DebugHandler;
use \App\Core\Request;
use \ReflectionClass;

/**
 * All requests are send to a controller after being routed.
 * 
 * @see `Docs/Example.md` for an example on how to use this class.
 */
abstract class Controller
{
    /**
     * Returns a function which calls the function name given as a parameter to this function.
     * 
     * The returned function takes a set of parameters.
     * 
     * The function given through $name will have its arguments injected based on the names of the parameters.
     * If an URI parameter `id` exists it can be used in the function by adding a `$id` parameter.
     */
    final public function defineControlledRoute(string $name): callable
    {
        return function ($parameters, Request $request) use ($name) {
            $reflectionClass = new ReflectionClass($this);
            $reflection = $reflectionClass->getMethod($name);
            $desiredParameters = $reflection->getParameters();

            $arguments = [];

            foreach ($desiredParameters as $parameter) {
                if ($parameter->getName() === "request") {
                    array_push($arguments, $request);
                    continue;
                }
                array_push(
                    $arguments,
                    isset($parameters[$parameter->getName()]) ? $parameters[$parameter->getName()] : null
                );
            }

            return call_user_func_array($reflection->getClosure($this), $arguments);
        };
    }

    /**
     * @deprecated use `Controller::defineControlledRoute` instead.
     */
    final public function parse(string $name): callable
    {
        DebugHandler::getInstance()->logMessage("DEPRECATED", "Deprecated function `Controller::parse` called. use `Controller::defineControlledRoute instead.`");
        return $this->defineControlledRoute($name);
    }
}
