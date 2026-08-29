<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use BelongsToTenant;

    protected $fillable = ['tenant_id','name','code','type','status'];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }
}
