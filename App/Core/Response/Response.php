<?php

declare(strict_types=1);

namespace App\Core\Response;

use \App\Core\DebugHandler;

abstract class Response
{
    final public function apply(): void
    {
        $mode = getenv("APP_MODE");
        if ($mode === false) {
            $mode = "PRODUCTION";
        }

        $mode = strtoupper($mode);

        if ($mode === "DEVELOPMENT") {
            $this->applyDevelopment();
        } else if ($mode === "PRODUCTION") {
            $this->applyProduction();
        } else {
            DebugHandler::getInstance()->logMessage("WARNING", "Unrecognized application mode: '$mode'");
            $this->applyProduction();
        }
    }

    abstract protected function applyProduction(): void;
    abstract protected function applyDevelopment(): void;
}
