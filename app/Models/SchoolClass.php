<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{

    protected $fillable = ['name', 'grade', 'status'];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }
}
