<?php

namespace App\Models\Scopes;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if ($tenant = Tenant::current()) {
            $builder->where($model->getTable() . '.tenant_id', $tenant->getKey());

            return;
        }

        // No current tenant: fail closed so a request outside the
        // tenant middleware never leaks cross-tenant data. Console
        // usage (seeders, tinker, tests) is exempt so those keep working.
        if (! app()->runningInConsole()) {
            $builder->whereRaw('1 = 0');
        }
    }
}
