<?php

declare(strict_types=1);

namespace App\Core\Response;

use \App\Core\View;
use \App\Core\Response\Response;
use \App\Core\Exception\RequestException;

final class ExceptionResponse extends Response
{
    public function __construct(RequestException $exception)
    {
        $this->exception = $exception;
    }

    protected function applyProduction(): void
    {
        $this->renderHtml(true);
    }

    protected function applyDevelopment(): void
    {
        $this->renderHtml(false);
    }

    private function renderHtml($isProduction): void
    {
        $hideMessage = $this->exception->getHideInProduction() && $isProduction;

        $response = View::view($this->exception->getView(), [
            "httpStatusCode" => $this->exception->getHttpStatusCode(),
            "message" => $hideMessage ? "" : $this->exception->getErrorMessage(),
        ]);

        http_response_code($this->exception->getHttpStatusCode());
        $response->apply();
    }

    private RequestException $exception;
}
