<?php

namespace App\Http\Middleware;

use App\Models\School;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IdentifyTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $subdomain = $request->route('subdomain');

        $school = School::where('subdomain', $subdomain)->where('is_active', true)->first();
        if (!$school) {
            abort(404, "School Not Found");
        }
        session(['current_school_id' => $school->id]);

        dd(session('current_school_id'));

        return $next($request);
    }
}
