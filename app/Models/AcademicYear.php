<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use BelongsToTenant;

    protected $fillable = ['tenant_id', 'name', 'start_date', 'end_date', 'is_current', 'status'];

    protected function casts(): array
    {
        return [
            'is_current' => 'boolean',
            'status' => 'boolean',
        ];
    }
}
