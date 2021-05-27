<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;
use App\Models\User;

final class Recipe extends Model
{
    protected array $columns = ["id", "title", "description", "author_id", "preparation_time", "cooking_time", "num_servings", "image"];
    protected string $table = "recipes";


    // Relation functions
    public function author(): User
    {
        return $this->relationFromKey(
            "authorRelation",
            "users",
            "id",
            "author_id",
            function () {
                return new User();
            }
        );
    }


    protected ?User $authorRelation = null;
}
