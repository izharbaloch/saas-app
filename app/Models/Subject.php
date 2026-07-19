<?php

namespace App\Models;

use App\Traits\BelongsToSchool;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use BelongsToSchool;

    protected $fillable = ['school_id','name','code','type','status'];

    public function casts() : array
    {
        return [
            'status' => 'boolean'
        ];
    }
}
