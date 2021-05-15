<?php

declare(strict_types=1);

namespace App\Core;

use \App\Core\DebugHandler;
use \App\Core\RelationManager;

abstract class Model
{
    abstract protected function serialize(): array;
    abstract public function deSerialize(array $data): void;

    final public function store()
    {
        DebugHandler::getInstance()->logMessage("info", json_encode($this->serialize()));
    }

    public function __toString()
    {
        return json_encode($this->serialize());
    }

    final protected function relationFromKey(string $property, string $referencedTable, string $id, string $key, callable $generator)
    {
        if ($this->$property === null) {
            $this->$property = RelationManager::getInstance()->loadRelationFromKey($this, $referencedTable, $id, $key, $generator);
        }

        return $this->$property;
    }
}
