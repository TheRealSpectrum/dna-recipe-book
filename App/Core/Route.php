<?php

declare(strict_types=1);

namespace App\Core;

use \Throwable;
use \App\Core\DebugHandler;
use \App\Core\Request;
use \App\Core\Exception\RequestException;
use \App\Core\Response\ExceptionResponse;

/**
 * Pure static class used for routing.
 * 
 * @see `Docs/Example.md` for a clear example on how to use this class.
 */
final class Route
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

    public static function resource(string $uri, string $controller)
    {
        return function (Request $request) use ($uri, $controller) {
            return Route::searchInRoutesArray($request, [
                Route::get($uri, [$controller, "index"]),
                Route::get("$uri/create", [$controller, "create"]),
                Route::post($uri, [$controller, "store"]),
                Route::get("$uri/:id", [$controller, "show"]),
                Route::get("$uri/:id/edit", [$controller, "edit"]),
                Route::patch("$uri/:id", [$controller, "update"]),
                Route::delete("$uri/:id", [$controller, "destroy"]),
            ]);
        };
    }

    /**
     * Run the router
     * 
     * @param array $routes list of all possible routes in order.
     *  The first route that matches will be applied.
     *  Use other functions in `Route` to define the routes.
     */
    public static function run(array $routes): void
    {
        $request = new Request($_SERVER["REQUEST_URI"]);
        $content = null;
        try {
            $requestUri = explode("/", $_SERVER['REQUEST_URI']);
            while (!empty($requestUri) && $requestUri[0] === "") {
                $requestUri = array_slice($requestUri, 1);
            }
            while (!empty($requestUri) && $requestUri[count($requestUri) - 1] === "") {
                $requestUri = array_slice($requestUri, 0, count($requestUri) - 1);
            }
            $result = Route::searchInRoutesArray($request, $routes);
            if ($result === null) {
                throw new RequestException("No matching route", 404);
            }
            $content = $result["callback"]($result["parameters"], $request);
        } catch (RequestException $error) {
            $content = new ExceptionResponse($error);
            DebugHandler::getInstance()->logMessage("ERROR", $error->getMessage(), $error->getFile(), $error->getLine());
        } catch (Throwable $error) {
            $content = new ExceptionResponse(
                new RequestException($error->getMessage())
            );
            DebugHandler::getInstance()->logMessage("ERROR", $error->getMessage(), $error->getFile(), $error->getLine());
        }
        $content->apply();
    }

    /**
     * @deprecated use `Route::run` instead.
     */
    public static function list(array $routes): void
    {
        DebugHandler::getInstance()->logMessage("DEPRECATED", "Deprecated function `Route::list` called. Use `Route::run` instead.");
        Route::run($routes);
    }

    private static function searchInRoutesArray(Request $request, array $routes): ?array
    {
        foreach ($routes as $route) {
            $result = $route($request);
            if ($result !== null) {
                return $result;
            }
        }
        return null;
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

        return function (Request $requestUri) use ($desiredUri, $callback, $method) {
            if (
                $method !== $_SERVER["REQUEST_METHOD"]
                && ($_SERVER["REQUEST_METHOD"] !== "POST"
                    || $requestUri->getParameter("_method") !== $method)
            ) {
                return null;
            }

            $compareResult = $requestUri->compare($desiredUri);

            if ($compareResult === null) {
                return null;
            }

            $routeCallback = $callback;
            if (gettype($callback) === "array") {
                $controllerReflection = new \ReflectionClass($callback[0]);
                $controllerInstance = $controllerReflection->newInstance();
                $routeCallback = $controllerInstance->defineControlledRoute($callback[1]);
            }

            return [
                "parameters" => $compareResult,
                "callback" => $routeCallback,
            ];
        };
    }
}
