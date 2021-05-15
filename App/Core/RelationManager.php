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

    public function loadRelationFromKey(Model $subject, string $referencedTable, string $id, string $key, callable $generator): array | Model
    {
        if (!empty($this->batch)) {
            $keys = [];

            foreach ($this->batch as $batchSubject) {
                array_push($keys, $batchSubject->$key);
            }

            $keyList = implode(", ", $keys);

            $batchQuery = "SELECT * FROM `$referencedTable` WHERE `$id` IN ($keyList)";

            return Database::getInstance()->getModels($batchQuery, $generator);
        }

        $query = "SELECT * FROM `$referencedTable` WHERE `$id` IS {$subject->$key} LIMIT 1";
        return Database::getInstance()->getModels($query, $generator)[0];
    }

    private array $batch = [];

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
