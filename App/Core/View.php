<?php

declare(strict_types=1);

namespace App\Core;

class View
{
    public static function view(string $viewName, array $viewContext = [])
    {
        foreach ($viewContext as $key => $value) {
            $$key = $value;
        }

        include "Views/" . $viewName . ".php";
    }
}
