<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{

    protected $fillable = ['name','code','type','status'];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }
}
