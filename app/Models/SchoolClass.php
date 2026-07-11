<?php

namespace App\Models;

use App\Traits\BelongsToSchool;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use BelongsToSchool;
    protected $fillable = ['school_id', 'name', 'grade', 'status'];
}
