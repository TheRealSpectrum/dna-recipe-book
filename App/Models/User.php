<?php

declare(strict_types=1);

namespace App\Models;

use \App\Core\Model;

use \App\Models\Recipe;

final class User extends Model
{
    protected array $columns = ["id", "name", "password", "isAdmin"];
    protected string $table = "users";

    public function recipes(): array
    {
        return $this->relationMany("recipesRelation", "recipes", "id", "author_id", function () {
            return new Recipe();
        });
    }

    protected ?array $recipesRelation = null;
}
