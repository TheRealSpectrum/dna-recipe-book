<?php

declare(strict_types=1);

namespace App\Core;

use \App\Core\DebugHandler;

final class Database
{
    // Singleton
    public static function getInstance()
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new Database();
        }

        return $instance;
    }

    public function connect(): void
    {
        $host = getenv("DB_HOST");
        $user = getenv("DB_USER");
        $password = getenv("DB_PASSWORD");
        $database = getenv("DB_DATABASE");

        if ($host === false) {
            $host = "localhost";
        }

        if ($user === false) {
            $user = "root";
        }

        if ($password === false) {
            $password = "";
        }

        if ($database === false) {
            $database = "database";
        }

        $this->database = new \mysqli($host, $user, $password, $database);
        if ($this->database->connect_error) {
            // todo: thow custom exception
            throw new \Exception("Database connection failed: {$this->database->connect_error}");
        }
    }

    public function disconnect(): void
    {
        $this->database->close();
        $this->database = null;
    }

    public function getModels(string $query, callable $generator): array
    {
        $result = $this->getRaw($query);

        $models = [];

        foreach ($result as $singleResult) {
            $nextModel = $generator();
            $nextModel->deSerialize($singleResult);
            array_push($models, $nextModel);
        }

        return $models;
    }

    public function getRaw(string $query): array
    {
        $queryResult = $this->database->query($query);
        if ($queryResult === false) {
            DebugHandler::getInstance()->logMessage("ERROR", "Query failed: `$query`");
            throw new \Exception("Query failed");
        }
        $result = $queryResult === true ? [] : $queryResult->fetch_array(MYSQLI_ASSOC) ?? [];
        if ($result === false) {
            $result = [];
        }

        DebugHandler::getInstance()->logQuery($query, $result);

        return $result;
    }

    private function __construct()
    {
    }

    private ?\mysqli $database = null;
}
