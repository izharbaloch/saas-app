<?php

namespace App\Traits;

use App\Models\Scopes\SchoolScope;

trait BelongsToSchool
{
    protected static function bootBelongsToSchool()
    {
        static::addGlobalScope(new SchoolScope);

        static::creating(function ($model) {
            if (session()->has('current_school_id')) {
                $model->school_id = session('current_school_id');
            }
        });
    }
}
