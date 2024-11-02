<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Concerns\HasUuids, Model, SoftDeletes};

class Category extends Model
{
    use SoftDeletes;
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeLike($query, string | array $column, ?string $value = null): void
    {
        if (is_string($column)) {
            $column = [$column];
        }

        if (filled($value)) {
            $query->whereAny($column, 'like', "$value%");
        }
    }
}
