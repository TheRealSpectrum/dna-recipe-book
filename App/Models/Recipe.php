<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;
use App\Models\User;
use App\Models\Step;
use App\Models\Ingredient;
use App\Models\Category;

final class Recipe extends Model
{
    protected array $columns = ["id", "title", "description", "author_id", "preparation_time", "cooking_time", "num_servings", "image"];
    protected string $table = "recipes";


    public function listCategoryAsLinks(): string
    {
        $results = [];
        foreach ($this->categories() as $category) {
            array_push($results, "<a href=\"/categories/{$category->id}\">{$category->title}</a>");
        }

        return implode(" - ", $results);
    }

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

    public function steps(): array
    {
        return $this->relationMany(
            "stepsRelation",
            "steps",
            "id",
            "recipe_id",
            function () {
                return new Step();
            }
        );
    }

    public function ingredients(): array
    {
        return $this->relationMany(
            "ingredientsRelation",
            "ingredients",
            "id",
            "recipe_id",
            function () {
                return new Ingredient();
            }
        );
    }

    public function categories(): array
    {
        return $this->relationIntersect(
            "categoriesRelation",
            "recipe_categories",
            "categories",
            "id",
            "recipe_id",
            "id",
            "category_id",
            function () {
                return new Category();
            }
        );
    }


    protected ?User $authorRelation = null;
    protected ?array $stepsRelation = null;
    protected ?array $ingredientsRelation = null;
    protected ?array $categoriesRelation = null;
}
