<?php

declare(strict_types=1);

namespace App\Core;

use \App\Core\DebugHandler;

class Route
{
    public static function get(string $uri, $callback)
    {
        return Route::route("GET", $uri, $callback);
    }

    public static function post(string $uri, $callback)
    {
        return Route::route("POST", $uri, $callback);
    }

    public static function put(string $uri, $callback)
    {
        return Route::route("PUT", $uri, $callback);
    }

    public static function patch(string $uri, $callback)
    {
        return Route::route("PATCH", $uri, $callback);
    }

    public static function delete(string $uri, $callback)
    {
        return Route::route("DELETE", $uri, $callback);
    }

    public static function list(array $routes)
    {
        $requestUri = explode("/", $_SERVER['REQUEST_URI']);
        while (!empty($requestUri) && $requestUri[0] === "") {
            $requestUri = array_slice($requestUri, 1);
        }
        while (!empty($requestUri) && $requestUri[count($requestUri) - 1] === "") {
            $requestUri = array_slice($requestUri, 0, count($requestUri) - 1);
        }

        foreach ($routes as $route) {
            $result = $route($requestUri);
            if ($result === null) {
                continue;
            }

            $content = $result["callback"]($result["parameters"]);
            echo DebugHandler::getInstance()->injectDebugBar($content);

            break;
        }
    }

    private static function route(string $method, string $uri, $callback)
    {
        $desiredUri = explode("/", $uri);

        while (!empty($desiredUri) && $desiredUri[0] === "") {
            $desiredUri = array_slice($desiredUri, 1);
        }
        while (!empty($desiredUri) && $desiredUri[count($desiredUri) - 1] === "") {
            $desiredUri = array_slice($desiredUri, 0, count($desiredUri) - 1);
        }

        return function ($requestUri) use ($desiredUri, $callback, $method) {
            if ($method !== $_SERVER["REQUEST_METHOD"]) {
                return null;
            }
            if (count($desiredUri) !== count($requestUri)) {
                return null;
            }

            $result = [
                "parameters" => [],
                "callback" => $callback,
            ];

            foreach ($requestUri as $index => $value) {
                if ($value === $desiredUri[$index]) {
                    continue;
                }

                if ($desiredUri[$index][0] === ":") {
                    $result["parameters"][substr($desiredUri[$index], 1)] = $value;
                    continue;
                }

                return null;
            }

            return $result;
        };
    }
}
