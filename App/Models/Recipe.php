<?php

namespace App\Models;

use App\Core\Model;

final class Recipe extends Model 
{
    protected array $columns = ["id", "title", "description", "author_id", "preparation_time", "cooking_time", "num_servings", "image"]; 
    protected string $table = "recipes";


    // Relation functions


    protected ?Recipe $referencedRelation = null;
    protected ?Recipe $oneRelation = null;
    protected ?array $manyRelation = null;
}