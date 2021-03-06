<?php

declare(strict_types=1);

namespace App\Core;

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

        $query = "SELECT * FROM `$referencedTable` WHERE `$id` = {$subject->$key} LIMIT 1";
        $class = new \ReflectionClass($generator());
        $method = $class->getMethod("query");
        return $method->invoke(null, $query)[0];
    }

    public function loadRelationOne(Model $subject, string $referenceTable, string $id, string $key, callable $generator): Model
    {
        if (!empty($this->batchSubjects)) {
            $ids = [];

            foreach ($this->batchSubjects as $batchSubject) {
                array_push($ids, $batchSubject->$id);
            }

            $idList = implode(', ', $ids);

            $batchQuery = "SELECT * FROM `$referenceTable` WHERE `$key` IN ($idList)";

            $batchResults = Database::getInstance()->query($batchQuery);

            foreach ($batchResults as $batchResult) {
                $this->batchResults[$batchResult[$key]] = $batchResult;
            }

            $this->batchSubjects = [];
        }

        if (!empty($this->batchResults)) {
            $result = $generator();
            $result->deSerialize($this->batchResults[$subject->$key]);
            return $result;
        }

        $query = "SELECT * FROM `$referenceTable` WHERE `$key` = {$subject->$id} LIMIT 1";
        $class = new \ReflectionClass($generator());
        $method = $class->getMethod("query");
        return $method->invoke(null, $query)[0];
    }

    public function loadRelationMany(Model $subject, string $referenceTable, string $id, string $key, callable $generator): array
    {
        if (!empty($this->batchSubjects)) {
            $ids = [];

            foreach ($this->batchSubjects as $batchSubject) {
                array_push($ids, $batchSubject->$id);
            }

            $idList = implode(', ', $ids);

            $batchQuery = "SELECT * FROM `$referenceTable` WHERE `$key` IN ($idList)";

            $batchResults = Database::getInstance()->query($batchQuery);

            foreach ($batchResults as $batchResult) {
                if (!array_key_exists($batchResult[$key], $this->batchResults)) {
                    $this->batchResults[$batchResult[$key]] = [];
                }
                $model = $generator();
                $model->deSerialize($batchResult);
                array_push($this->batchResults[$batchResult[$key]], $model);
            }

            $this->batchSubjects = [];
        }

        if (!empty($this->batchResults)) {
            return $this->batchResults[$subject->$key];
        }

        $query = "SELECT * FROM `$referenceTable` WHERE `$key` = {$subject->$id}";
        $class = new \ReflectionClass($generator());
        $method = $class->getMethod("query");
        return $method->invoke(null, $query);
    }

    public function loadRelationIntersect(Model $subject, string $intersectTable, string $referencedTable, string $selfId, string $selfKey, string $otherId, string $otherKey, callable $generator): array
    {
        if (!empty($this->batchSubjects)) {
            $ids = [];

            foreach ($this->batchSubjects as $batchSubject) {
                array_push($ids, $batchSubject->$selfId);
            }

            $idList = implode(", ", $ids);

            $batchIntersectQuery = "SELECT * FROM `$intersectTable` WHERE `$selfKey` IN ($idList)";

            $batchIntersectResults = Database::getInstance()->query($batchIntersectQuery);

            $keys = [];

            foreach ($batchIntersectResults as $intersectResult) {
                array_push($keys, $intersectResult[$otherKey]);
            }

            $keys = array_unique($keys);

            $keyList = implode(", ", $keys);

            $batchQuery = "SELECT * FROM `$referencedTable` WHERE `$otherId` IN ($keyList)";

            $batchResults = Database::getInstance()->query($batchQuery);
            $batchMap = [];

            foreach ($batchResults as $batchResult) {
                $model = $generator();
                $model->fill($batchResult);
                $batchMap[$batchResult->$otherId] = $model;
            }

            foreach ($batchIntersectResults as $intersectResult) {
                if (!array_key_exists($intersectResult[$selfKey], $this->batchResults)) {
                    $this->batchResults[$intersectResult[$selfKey]] = [];
                }
                array_push($this->batchResults[$intersectResult[$selfKey]], $batchMap[$intersectResult[$otherKey]]);
            }

            $this->batchSubject = [];
        }

        if (!empty($this->batchResults)) {
            return $this->batchResults[$subject->$selfId];
        }

        $intersectQuery = "SELECT * FROM `$intersectTable` WHERE `$selfKey` = {$subject->$selfId}";
        $intersectResults = Database::getInstance()->query($intersectQuery);

        $keys = [];

        foreach ($intersectResults as $intersectResult) {
            array_push($keys, $intersectResult[$otherKey]);
        }

        if (count($keys) === 0) {
            return [];
        }

        $keyList = implode(", ", $keys);

        $query = "SELECT * FROM `$referencedTable` WHERE `$otherId` in ($keyList)";

        $class = new \ReflectionClass($generator());
        $method = $class->getMethod("query");
        return $method->invoke(null, $query);
    }

    public function batchLoad(array $subjects, string $relation): void
    {
        $this->batchSubjects = $subjects;
        $reflection = new \ReflectionClass($subjects[0]);
        $relationFunction = $reflection->getMethod($relation);
        foreach ($subjects as $subject) {
            $relationFunction->invoke($subject);
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
