<?php

declare(strict_types=1);

namespace App\Core\Exception;

use \Exception;

class RequestException extends Exception
{
    public function __construct(string $errorMessage, int $httpStatusCode = 500, bool $hideInProduction = true, string $view = "")
    {
        $this->errorMessage = $errorMessage;
        $this->httpStatusCode = $httpStatusCode;
        $this->hideInProduction = $hideInProduction;
        $this->view = empty($view) ? "Except/$httpStatusCode" : $view;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }

    public function getHideInProduction(): bool
    {
        return $this->hideInProduction;
    }

    public function getView(): string
    {
        return $this->view;
    }

    private string $errorMessage;
    private int $httpStatusCode;
    private bool $hideInProduction;
    private string $view;
}
