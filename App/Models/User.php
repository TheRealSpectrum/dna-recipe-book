<?php

use App\Core\Model;

final class User extends Model 
{
    protected array $columns = ["id", "name", "password", "isAdmin"]; 
    protected string $table = "users";

    

    // Relation functions


    protected ?Recipe $referencedRelation = null;
    protected ?Recipe $oneRelation = null;
    protected ?array $manyRelation = null;
}