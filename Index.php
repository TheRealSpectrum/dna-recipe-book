<?php

declare(strict_types=1);

use App\Core\DebugHandler;
use App\Core\Model;
use App\Core\Database;

spl_autoload_register(
    function ($className) {
        include str_replace("\\", "/", $className) . ".php";
    }
);

DebugHandler::getInstance()->startup();

class DemoModel extends Model
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

    private int $id;
    private string $name;
    private int $admin;
}

$models = Database::getInstance()->getModels("SELECT * FROM `users` WHERE `admin` IS 1", function () {
    return new DemoModel();
});

foreach ($models as $i => $model) {
    DebugHandler::getInstance()->logMessage("info", "[" . $i . "] => " . $model);
}


include "Routes.php";
