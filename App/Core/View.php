<?php

declare(strict_types=1);

namespace App\Core;

use \App\Core\Response\HtmlResponse;

class View
{
    public static function view(string $viewName, array $viewContext = [], ?string $layoutName = null): HtmlResponse
    {
        foreach ($viewContext as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include "Views/" . $viewName . ".php";
        $viewResult = ob_get_contents();
        ob_end_clean();

        if ($layoutName === null) {
            return new HtmlResponse($viewResult);
        }

        $yield = function () use ($viewResult) {
            return $viewResult;
        };

        ob_start();
        include "Layouts/$layoutName.php";
        $layoutResult = ob_get_contents();
        ob_end_clean();

        return new HtmlResponse($layoutResult);
    }

    public static function component(string $componentName, array $componentContext): string
    {
        foreach ($componentContext as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include "Components/" . $componentName . ".php";
        $componentResult = ob_get_contents();
        ob_end_clean();

        return $componentResult;
    }
}
