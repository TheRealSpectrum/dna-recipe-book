<?php

declare(strict_types=1);

namespace App\Core\Response;

use \App\Core\DebugHandler;
use \App\Core\Environment;

abstract class Response
{
    final public function apply(): void
    {
        $mode = strtoupper(Environment::getInstance()->getEnvironment("APP_MODE", "PRODUCTION"));

        if ($mode === "DEVELOPMENT") {
            $this->applyDevelopment();
        } else if ($mode === "PRODUCTION") {
            $this->applyProduction();
        } else {
            DebugHandler::getInstance()->logMessage("WARNING", "Unrecognized application mode: '$mode'. Defaulting to 'PRODUCTION'.");
            $this->applyProduction();
        }
    }

    abstract protected function applyProduction(): void;
    abstract protected function applyDevelopment(): void;
}
