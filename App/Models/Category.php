<?php

use App\Core\Model;

final class Category extends Model 
{
    protected array $columns = ["id", "title", "description"]; 
    protected string $table = "categories";

    

    // Relation functions


    protected ?Recipe $referencedRelation = null;
    protected ?Recipe $oneRelation = null;
    protected ?array $manyRelation = null;
}