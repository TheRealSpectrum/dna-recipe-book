<?php

use App\Core\Model;

final class Ingredient extends Model 
{
    protected array $columns = ["id", "title", "description", "index", "recipe_id"]; 
    protected string $table = "steps";

    

    // Relation functions


    protected ?Recipe $referencedRelation = null;
    protected ?Recipe $oneRelation = null;
    protected ?array $manyRelation = null;
}