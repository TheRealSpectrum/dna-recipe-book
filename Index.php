<?php

declare(strict_types=1);

use App\Core\DebugHandler;
use App\Core\Database;

spl_autoload_register(
    function ($className) {
        include str_replace("\\", "/", $className) . ".php";
    }
);

DebugHandler::getInstance()->startup();
try {
    Database::getInstance()->connect();
} catch (\Throwable $error) {
    DebugHandler::getInstance()->logMessage("ERROR", (string)$error);
}

class ConcreteModel extends \App\Core\Model
{
    protected function serialize(): array
    {
        return [];
    }

    public function deSerialize(array $data): void
    {
    }

    protected array $columns = ["id", "name", "admin"];
    protected string $table = "users";
}

$concreteModels = ConcreteModel::query("SELECT * FROM `users` WHERE `admin` = 1");

foreach ($concreteModels as $model) {
    DebugHandler::getInstance()->logMessage("INFO", (string)$model);
    $model->name .= "+";
    $model->store();
}

$newModel = ConcreteModel::create([
    "name" => "Ian",
    "admin" => 0,
]);

$newModel->store();

include "Routes.php";

Database::getInstance()->disconnect();
