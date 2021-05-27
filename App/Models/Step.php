<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

final class Step extends Model 
{
    protected array $columns = ["id", "title", "description", "index", "recipe_id"]; 
    protected string $table = "steps";

    

    // Relation functions


    protected ?Step $referencedRelation = null;
    protected ?Step $oneRelation = null;
    protected ?Step $manyRelation = null;
}