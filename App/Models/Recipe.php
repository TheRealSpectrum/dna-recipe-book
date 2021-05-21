<?php

use App\Core\Model;

final class Recipe extends Model 
{
    protected array $columns = ["id", "title", "description", "author", "preparation_time", "cooking_time", "servings", "image"]; 
    protected string $table = "recipes";
}