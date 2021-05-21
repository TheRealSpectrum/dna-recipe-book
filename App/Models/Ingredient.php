<?php

use App\Core\Model;

final class Ingredient extends Model 
{
    protected array $columns = ["id", "recipe_id", "name", "quantity"]; 
    protected string $table = "ingredients";

    

    // Relation functions


    protected ?Recipe $referencedRelation = null;
    protected ?Recipe $oneRelation = null;
    protected ?array $manyRelation = null;
}