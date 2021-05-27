<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

final class Recipe extends Model 
{
    protected array $columns = ["id", "title", "description", "author_id", "preparation_time", "cooking_time", "num_servings", "image"]; 
    protected string $table = "recipes";


    // Relation functions
    public function author() : User
    {
        return $this->relationOne(
            "authorRelation",
            "users",
            "author_id",
            "id",
            function ()
            {
                return new User();
            }
        );
    }


    protected ?Recipe $referencedRelation = null;
    protected ?Recipe $authorRelation = null;
    protected ?array $manyRelation = null;
}