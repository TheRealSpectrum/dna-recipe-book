<?php

declare(strict_types=1);

use App\Core\DebugHandler;
use App\Core\Model;
use App\Core\Database;
use App\Core\RelationManager;

spl_autoload_register(
    function ($className) {
        include str_replace("\\", "/", $className) . ".php";
    }
);

DebugHandler::getInstance()->startup();

final class DemoModel extends Model
{
    protected function serialize(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "admin" => $this->admin,
        ];
    }

    public function deSerialize(array $data): void
    {
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->admin = $data["admin"];
    }

    public function test(): DemoModel
    {
        return $this->relationFromKey("testRelation", "test", "id", "id", function () {
            return new DemoModel();
        });
    }

    public function one(): DemoModel
    {
        return $this->relationOne("oneRelation", "once", "id", "id", function () {
            return new DemoModel();
        });
    }

    public function many(): array
    {
        return $this->relationMany("manyRelation", "twice", "id", "id", function () {
            return new DemoModel();
        });
    }

    public int $id;
    private string $name;
    private int $admin;
    protected ?DemoModel $testRelation = null;
    protected ?DemoModel $oneRelation = null;
    protected ?array $manyRelation = null;
}

$models = Database::getInstance()->getModels("SELECT * FROM `users` WHERE `admin` IS 1", function () {
    return new DemoModel();
});

foreach ($models as $i => $model) {
    DebugHandler::getInstance()->logMessage("INFO", "[" . $i . "] => " . $model);
}

RelationManager::getInstance()->batchLoad($models, "test");
RelationManager::getInstance()->batchLoad($models, "one");
RelationManager::getInstance()->batchLoad($models, "many");

foreach ($models as $i => $model) {
    DebugHandler::getInstance()->logMessage("INFO", "[" . $i . "] => " . $model->test());
    DebugHandler::getInstance()->logMessage("INFO", "[" . $i . "] => " . $model->one());
    foreach ($model->many() as $j => $oneOfMany) {
        DebugHandler::getInstance()->logMessage("INFO", "[" . $i . "," . $j . "] => " . $oneOfMany);
    }
}


include "Routes.php";
