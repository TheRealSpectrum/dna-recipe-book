<?php

declare(strict_types=1);

use App\Core\DebugHandler;

spl_autoload_register(
    function ($className) {
        include str_replace("\\", "/", $className) . ".php";
    }
);

DebugHandler::getInstance()->startup();

class ConcreteModel extends \App\Core\Model
{
    protected function serialize(): array
    {
        return [];
    }

    public function deSerialize(array $data): void
    {
    }

    protected array $rows = ["id", "name", "admin"];
    protected string $table = "users";
}

$concreteModels = ConcreteModel::query("SELECT * FROM `users` WHERE `admin` IS 1");

foreach ($concreteModels as $model) {
    DebugHandler::getInstance()->logMessage("INFO", (string)$model);
    $model->store();
}

$newModel = ConcreteModel::create([
    "name" => "Maaike",
    "admin" => 0,
]);

$newModel->store();

include "Routes.php";
