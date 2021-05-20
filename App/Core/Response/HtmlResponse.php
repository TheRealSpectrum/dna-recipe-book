<?php

declare(strict_types=1);

namespace App\Core\Response;

use \App\Core\DebugHandler;
use \App\Core\Response\Response;

class HtmlResponse extends Response
{
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    protected function applyProduction(): void
    {
        echo $this->content;
    }

    protected function applyDevelopment(): void
    {
        echo DebugHandler::getInstance()->injectDebugBar($this->content);
    }

    private string $content;
}
