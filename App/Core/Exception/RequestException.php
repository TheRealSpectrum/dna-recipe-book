<?php

declare(strict_types=1);

namespace App\Core\Exception;

use \Exception;
use \App\Core\View;
use \App\Core\Response\HtmlResponse;

class RequestException extends \Exception
{
    public function __construct(string $errorMessage, int $httpStatusCode = 500, bool $hideInProduction = true, string $view = "")
    {
        $this->errorMessage = $errorMessage;
        $this->httpStatusCode = $httpStatusCode;
        $this->hideInProduction = $hideInProduction;
        $this->view = empty($view) ? "Except/$httpStatusCode.php" : $view;
    }

    public function getHtml(): HtmlResponse
    {
        $hideMessage = false;
        if ($this->hideInProduction) {
            $mode = getenv("APP_MODE");
            if ($mode === false) {
                $mode = "PRODUCTION";
            }

            $mode = strtoupper($mode);

            if ($mode !== "DEVELOPMENT") {
                $hideMessage = true;
            }
        }

        return View::view($this->view, [
            "httpStatusCode" => $this->httpStatusCode,
            "message" => $hideMessage ? "" : $this->errorMessage,
        ]);
    }

    private string $errorMessage;
    private int $httpStatusCode;
    private bool $hideInProduction;
    private string $view;
}
