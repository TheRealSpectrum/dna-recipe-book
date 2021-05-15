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

    public int $id;
    private string $name;
    private int $admin;
    protected ?DemoModel $testRelation = null;
}

$models = Database::getInstance()->getModels("SELECT * FROM `users` WHERE `admin` IS 1", function () {
    return new DemoModel();
});

foreach ($models as $i => $model) {
    DebugHandler::getInstance()->logMessage("INFO", "[" . $i . "] => " . $model);
}

RelationManager::getInstance()->batchLoad($models, "test");

foreach ($models as $i => $model) {
    DebugHandler::getInstance()->logMessage("INFO", "[" . $i . "] => " . $model->test());
}


include "Routes.php";
