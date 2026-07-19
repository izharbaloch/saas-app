<?php

namespace App\Models;

use App\Traits\BelongsToSchool;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use BelongsToSchool;

    protected $fillable = ['school_id', 'name', 'start_date', 'end_date', 'is_current', 'status'];

    public function casts(): array
    {
        return [
            'is_current' => 'boolean',
            'status' => 'boolean',
        ];
    }
}
