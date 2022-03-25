<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class EnsureUserIsOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next)
    public function handle(Request $request, Closure $next, $model_type)
    {
        $resource = $request->route()->parameter($model_type);
        if ($request->user() != $resource->user) {
            abort(403, 'Unauthorized action');
        } else {
            return $next($request);
        }
    }
}
