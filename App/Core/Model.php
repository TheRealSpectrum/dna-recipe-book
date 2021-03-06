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
    /**
     * @deprecated
     */
    protected function serialize(): array
    {
        DebugHandler::getInstance()->logMessage("DEPRECATED", "Deprecated function `Model::serialize`");
        return [];
    }
    /**
     * @deprecated
     */
    public function deSerialize(array $data): void
    {
        DebugHandler::getInstance()->logMessage("DEPRECATED", "Deprecated function `Model::deSerialize`");
    }

    final static public function create(array $values): Model
    {
        $reflection = new \ReflectionClass(get_called_class());
        $result = $reflection->newInstance();

        $result->fill($values);

        return $result;
    }

    final static public function query(string $query): array
    {
        $reflection = new \ReflectionClass(get_called_class());
        $queryResult = Database::getInstance()->query($query);

        $result = [];

        foreach ($queryResult as $modelData) {
            $next = $reflection->newInstance();
            $next->fill($modelData);
            $next->new = false;
            array_push($result, $next);
        }

        return $result;
    }

    /**
     * Store current state in the database.
     */
    final public function store()
    {
        if ($this->new) {
            $columns = [];
            $data = [];
            foreach ($this->columns as $column) {
                if (property_exists($this, $column)) {
                    $value = "";
                    switch (gettype($this->$column)) {
                        case "NULL":
                            $value = "NULL";
                            break;
                        case "string":
                            $value = "\"{$this->$column}\"";
                            break;
                        case "integer":
                            $value = (string)$this->$column;
                            break;
                        default:
                            DebugHandler::getInstance()->logMessage("WARNING", "Unsupported type used in database: " . gettype($this->$column));
                            $value = (string)$this->$column;
                    }
                    array_push($columns, "`$column`");
                    array_push($data, $value);
                }
            }

            $columnsString = implode(', ', $columns);
            $dataString = implode(', ', $data);

            Database::getInstance()->query("INSERT INTO `{$this->table}` ($columnsString) VALUES ($dataString)");
            $this->new = false;
        } else {
            $updates = [];
            foreach ($this->columns as $column) {
                if (property_exists($this, $column) && $column !== $this->idColumn) {
                    $value = "";
                    switch (gettype($this->$column)) {
                        case "NULL":
                            $value = "NULL";
                            break;
                        case "string":
                            $value = "\"{$this->$column}\"";
                            break;
                        case "integer":
                            $value = (string)$this->$column;
                            break;
                        default:
                            DebugHandler::getInstance()->logMessage("WARNING", "Unsupported type used in database: " . gettype($this->$column));
                            $value = (string)$this->$column;
                    }
                    array_push($updates, "`$column` = $value");
                }
            }

            $updatesString = implode(", ", $updates);
            Database::getInstance()->query("UPDATE `{$this->table}` SET $updatesString WHERE `$this->table`.`{$this->idColumn}` = {$this->{$this->idColumn}}");
        }
    }

    public function __toString()
    {
        $data = [];
        foreach ($this->columns as $column) {
            if (property_exists($this, $column)) {
                $data[$column] = $this->$column;
            }
        }
        return json_encode($data);
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

    final protected function relationIntersect(string $property, string $intersectTable, string $referencedTable, string $selfId, string $selfKey, string $otherId, string $otherKey, callable $generator): array
    {
        if ($this->$property === null) {
            $this->$property = RelationManager::getInstance()->loadRelationIntersect($this, $intersectTable, $referencedTable, $selfId, $selfKey, $otherId, $otherKey, $generator);
        }

        return $this->$property;
    }

    protected array $columns = [];
    protected string $table = "";
    protected string $idColumn = "id";

    private bool $new = true;

    final public function fill(array $values): void
    {
        foreach ($values as $key => $value) {
            if (!in_array($key, $this->columns)) {
                throw new \Exception("Value of name $key not defined in Model");
            }
            $this->$key = $value;
        }
    }
}
