<?php

declare(strict_types=1);

namespace App\Core;

use \App\Core\DebugHandler;
use \App\Core\Environment;

final class Database
{
    // Singleton
    public static function getInstance(): Database
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new Database();
        }

        return $instance;
    }

    public function connect(): void
    {
        if ($this->database !== null) {
            DebugHandler::getInstance()->logMessage("WARNING", "database object already exists");
        }

        $host = Environment::getInstance()->getEnvironment("DB_HOST", "localhost");
        $user = Environment::getInstance()->getEnvironment("DB_USER", "root");
        $password = Environment::getInstance()->getEnvironment("DB_PASSWORD", "");
        $database = Environment::getInstance()->getEnvironment("DB_DATABASE");

        if ($database === false) {
            DebugHandler::getInstance()->logMessage("WARNING", "No database provided in environment.");
            return;
        }

        $this->database = new \mysqli($host, $user, $password, $database);
        if ($this->database->connect_error) {
            // todo: thow custom exception
            $this->database = null;
            DebugHandler::getInstance()->logMessage("ERROR", "Database connection failed: {$this->database->connect_error}");
        }
    }

    public function disconnect(): void
    {
        if ($this->database === null) {
            DebugHandler::getInstance()->logMessage("WARNING", "database object doesn't exists");
            return;
        }
        $this->database->close();
        $this->database = null;
    }

    /**
     * @deprecated use `Model::query` instead.
     */
    public function getModels(string $query, callable $generator): array
    {
        DebugHandler::getInstance()->logMessage("DEPRECATED", "Deprecated function `Database::getModels` called. Use `Model::query` instead.");
        $result = $this->getRaw($query);

        $models = [];

        foreach ($result as $singleResult) {
            $nextModel = $generator();
            $nextModel->deSerialize($singleResult);
            array_push($models, $nextModel);
        }

        return $models;
    }

    public function query(string $query): array
    {
        if ($this->database === null) {
            // todo: Add custom exception.
            throw new \Exception("Attempted query but there is no connection to a database");
        }

        $queryResult = $this->database->query($query);
        if ($queryResult === false) {
            DebugHandler::getInstance()->logMessage("ERROR", "Query failed: `$query`");
            throw new \Exception("Query failed");
        }
        $result = $queryResult === true ? [] : $queryResult->fetch_all(MYSQLI_ASSOC) ?? [];
        if ($result === false) {
            $result = [];
        }

        DebugHandler::getInstance()->logQuery($query, $result);

        return $result;
    }

    /**
     * @deprecated use `Database::query` instead.
     */
    public function getRaw(string $query): array
    {
        DebugHandler::getInstance()->logMessage("DEPRECATED", "Deprecated function `Database::getRaw` called. Use `Database::query` instead.");
        return $this->query($query);
    }

    private function __construct()
    {
    }

    private ?\mysqli $database = null;
}
