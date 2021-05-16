<?php

declare(strict_types=1);

namespace App\Core;

use \App\Core\DebugHandler;
use \App\Core\RelationManager;

/**
 * Base class for all models.
 * 
 * A model is responsible for all data of the application.
 * This data is stored in an SQL database.
 * 
 * Some variations on MVC connect the model to the view.
 * This is **not** the case for this project.
 * 
 * @see `Docs/Example.md` for a concrete example including how to use models.
 * @see https://zeekat.nl/articles/mvc-for-the-web.html.
 */
abstract class Model
{
    abstract protected function serialize(): array;
    abstract public function deSerialize(array $data): void;

    /**
     * Store current state in the database.
     */
    final public function store()
    {
        DebugHandler::getInstance()->logMessage("info", json_encode($this->serialize()));
    }

    public function __toString()
    {
        return json_encode($this->serialize());
    }

    /**
     * @see `Docs/Relations.md`.
     */
    final protected function relationFromKey(string $property, string $referencedTable, string $id, string $key, callable $generator): Model
    {
        if ($this->$property === null) {
            $this->$property = RelationManager::getInstance()->loadRelationFromKey($this, $referencedTable, $id, $key, $generator);
        }

        return $this->$property;
    }

    /**
     * @see `Docs/Relations.md`.
     */
    final protected function relationOne(string $property, string $referenceTable, string $id, string $key, callable $generator): Model
    {
        if ($this->$property === null) {
            $this->$property = RelationManager::getInstance()->loadRelationOne($this, $referenceTable, $id, $key, $generator);
        }

        return $this->$property;
    }

    /**
     * @see `Docs/Relations.md`.
     */
    final protected function relationMany(string $property, string $referenceTable, string $id, string $key, callable $generator): array
    {
        if ($this->$property === null) {
            $this->$property = RelationManager::getInstance()->loadRelationMany($this, $referenceTable, $id, $key, $generator);
        }

        return $this->$property;
    }
}
