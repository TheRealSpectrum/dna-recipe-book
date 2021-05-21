<?php

declare(strict_types=1);

namespace App\Core\Response;

use \App\Core\DebugHandler;
use \App\Core\Response\Response;

class RedirectResponse extends Response
{
    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    protected function applyProduction(): void
    {
        header("Location: {$this->uri}");
    }

    protected function applyDevelopment(): void
    {
        DebugHandler::getInstance()->storeInSession();
        header("Location: {$this->uri}");
    }

    private string $uri;
}
