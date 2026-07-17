<?php

namespace App\Models;

use App\Traits\BelongsToSchool;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use BelongsToSchool;
    protected $fillable = ['school_id', 'name', 'status'];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }
}
