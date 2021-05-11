<?php

declare(strict_types=1);

namespace App\Core;

class View
{
    public static function view(string $viewName, array $viewContext = []): string
    {
        foreach ($viewContext as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include "Views/" . $viewName . ".php";
        $viewResult = ob_get_contents();
        ob_end_clean();

        return $viewResult;
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
