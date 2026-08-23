<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SchoolScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (session()->has('current_school_id')) {
            $builder->where($model->getTable() . '.school_id', session('current_school_id'));

            return;
        }

        // No tenant in session: fail closed so a request outside the
        // tenant middleware never leaks cross-school data. Console
        // usage (seeders, tinker, tests) is exempt so those keep working.
        if (! app()->runningInConsole()) {
            $builder->whereRaw('1 = 0');
        }
    }
}
