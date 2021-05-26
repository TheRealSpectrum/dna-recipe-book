<?php

declare(strict_types=1);

namespace App\Core;

final class Request
{
    public function __construct(string $uri)
    {
        $splitUri = explode("?", $uri);

        $path = explode("/", $splitUri[0]);

        while (!empty($path) && $path[0] === "") {
            $path = array_slice($path, 1);
        }
        while (!empty($path) && $path[count($path) - 1] === "") {
            $path = array_slice($path, 0, count($path) - 1);
        }

        $parameters = count($splitUri) > 1 ? explode("&", $splitUri[1]) : [];
        $this->path = $path;
        $this->parameters = [];
        foreach ($parameters as $parameter) {
            $splitParameter = explode("=", $parameter);
            if (count($splitParameter) !== 2) {
                continue;
            }
            $this->parameters[$splitParameter[0]] = $splitParameter[1];
        }
    }

    public function __toString(): string
    {
        $result = [
            "path" => $this->path,
            "parameters" => $this->parameters,
        ];

        return json_encode($result);
    }

    public function compare($desiredPath): ?array
    {
        if (count($desiredPath) !== count($this->path)) {
            return null;
        }

        $result = [];

        $zippedPath = array_map(null, $desiredPath, $this->path);

        foreach ($zippedPath as $part) {
            if ($part[0][0] === ":") {
                $result[substr($part[0], 1)] = $part[1];
                continue;
            }

            if ($part[0] !== $part[1]) {
                return null;
            }
        }

        return $result;
    }

    public function getParameter(string $key): ?string
    {
        return isset($this->parameters[$key]) ? $this->parameters[$key] : null;
    }

    private array $path;
    private array $parameters;
}
