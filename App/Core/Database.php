<?php

declare(strict_types=1);

namespace App\Core;

use \App\Core\DebugHandler;

final class Database
{
    // Singleton
    public static function getInstance()
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new Database();
        }

        return $instance;
    }

    public function getModels(string $query, callable $generator): array
    {
        // todo: implement database and get result from there.
        $result = [
            [
                "id" => 1,
                "name" => "Damy",
                "admin" => 1,
            ],
            [
                "id" => 4,
                "name" => "Niels",
                "admin" => 1,
            ],
        ];

        DebugHandler::getInstance()->logQuery($query, $result);

        $models = [];

        foreach ($result as $singleResult) {
            $nextModel = $generator();
            $nextModel->deSerialize($singleResult);
            array_push($models, $nextModel);
        }

        return $models;
    }

    private function __construct()
    {
    }
}
