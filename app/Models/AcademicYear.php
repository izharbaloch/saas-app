<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{

    protected $fillable = ['name', 'start_date', 'end_date', 'is_current', 'status'];

    protected function casts(): array
    {
        return [
            'is_current' => 'boolean',
            'status' => 'boolean',
        ];
    }
}
