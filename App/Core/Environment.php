<?php

declare(strict_types=1);

namespace App\Core;

use \App\Core\DebugHandler;

final class Environment
{
    public static function getInstance(): Environment
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new Environment();
        }

        return $instance;
    }

    public function getEnvironment(string $key, ?string $default = null): ?string
    {
        if (array_key_exists($key, $this->entries)) {
            return $this->entries[$key];
        }

        $result = getenv($key);

        if ($result === false) {
            return $default;
        }

        return $result;
    }

    private function __construct()
    {
        if (file_exists(".env")) {
            $envData = explode("\n", file_get_contents(".env"));

            foreach ($envData as $line => $envEntry) {
                if (ctype_space($envEntry) || empty($envEntry)) {
                    continue;
                }

                $parts = explode("=", $envEntry);
                if (count($parts) !== 2) {
                    DebugHandler::getInstance()->logMessage("WARNING", "Invalid .env entry '$envEntry' ($line)");
                    continue;
                }

                $key = trim($parts[0]);
                $value = trim($parts[1]);

                $this->entries[$key] = $value;
            }
        }
    }

    private array $entries = [];
}
