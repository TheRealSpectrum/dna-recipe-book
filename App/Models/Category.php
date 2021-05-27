<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

final class Category extends Model
{
    protected array $columns = ["id", "title", "description"];
    protected string $table = "categories";
}
