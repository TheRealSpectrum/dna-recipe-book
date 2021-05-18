<?php

declare(strict_types=1);

namespace App\Core;

class View
{
    public static function view(string $viewName, array $viewContext = [], ?string $layoutName = null): string
    {
        foreach ($viewContext as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include "Views/" . $viewName . ".php";
        $viewResult = ob_get_contents();
        ob_end_clean();

        if ($layoutName === null) {
            return $viewResult;
        }

        $yield = function () use ($viewResult) {
            return $viewResult;
        };

        ob_start();
        include "Layouts/$layoutName.php";
        $layoutResult = ob_get_contents();
        ob_end_clean();

        return $layoutResult;
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
