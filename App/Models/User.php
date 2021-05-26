<?php

declare(strict_types=1);

namespace App\Models;

use \App\Core\Model;

final class User extends Model
{
    protected array $columns = ["id", "name", "password", "isAdmin"];
    protected string $table = "users";
}
