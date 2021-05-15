<?php

declare(strict_types=1);

namespace App\Core;

use \App\Core\DebugHandler;
use \App\Core\Database;
use \App\Core\Model;

final class RelationManager
{
    public static function getInstance(): RelationManager
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new RelationManager();
        }

        return $instance;
    }

    public function loadRelationFromKey(Model $subject, string $referencedTable, string $id, string $key, callable $generator): Model
    {
        if (!empty($this->batchSubjects)) {
            $keys = [];

            foreach ($this->batchSubjects as $batchSubject) {
                array_push($keys, $batchSubject->$key);
            }

            $keyList = implode(", ", $keys);

            $batchQuery = "SELECT * FROM `$referencedTable` WHERE `$id` IN ($keyList)";

            $batchResults = Database::getInstance()->getRaw($batchQuery);

            foreach ($batchResults as $batchResult) {
                $this->batchResults[$batchResult[$id]] = $batchResult;
            }

            $this->batchSubjects = [];
        }

        if (!empty($this->batchResults)) {
            $result = $generator();
            $result->deSerialize($this->batchResults[$subject->$key]);
            return $result;
        }

        $query = "SELECT * FROM `$referencedTable` WHERE `$id` IS {$subject->$key} LIMIT 1";
        return Database::getInstance()->getModels($query, $generator)[0];
    }

    public function batchLoad(array $subjects, string $relation): void
    {
        $this->batchSubjects = $subjects;
        $reflection = new \ReflectionClass($subjects[0]);
        $relationFunction = $reflection->getMethod($relation);
        foreach ($subjects as $subject) {
            $result = $relationFunction->invoke($subject);
            DebugHandler::getInstance()->logMessage("INFO", "BATCH $result");
        }

        $this->batchResults = [];
    }

    private array $batchSubjects = [];
    private array $batchResults = [];

    private function __construct()
    {
    }
}

/**
 * SELECT * FROM `users` WHERE `id` IN (1) LIMIT 1;
 * SELECT * FROM `addresses` WHERE `user_id` IN (1);
 * SELECT * FROM `comments` WHERE `user_id` IN (1);
 * SELECT * FROM `teams` WHERE `id` IN (SELECT DISTINCT `team_id` from `user_teams` WHERE `user_id` IN (1));
 */
