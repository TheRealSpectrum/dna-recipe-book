<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

use App\Models\Recipe;

final class Category extends Model
{
    protected array $columns = ["id", "title", "description"];
    protected string $table = "categories";

    public function recipes(): array
    {
        return $this->relationIntersect(
            "recipesRelation",
            "recipe_categories",
            "recipes",
            "id",
            "category_id",
            "id",
            "recipe_id",
            function () {
                return new Recipe();
            }
        );
    }

    protected ?array $recipesRelation = null;
}
