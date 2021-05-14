<?php

declare(strict_types=1);

use App\Core\DebugHandler;
use App\Core\Model;

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
            "a" => $this->a,
            "b" => $this->b,
        ];
    }

    public function deSerialize(array $data): void
    {
        $this->a = $data["a"];
        $this->b = $data["b"];
    }

    private int $a;
    private int $b;
}

$demo = new DemoModel();
$demo->deSerialize([
    "a" => 10,
    "b" => 20,
]);
$demo->store();

include "Routes.php";
