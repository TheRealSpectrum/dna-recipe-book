<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

final class Ingredient extends Model 
{
    protected array $columns = ["id", "recipe_id", "name", "quantity"]; 
    protected string $table = "ingredients";
    
}