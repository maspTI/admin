<?php

namespace App\Http\Middleware;

use Closure;

class HasDepartment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->department_id != null) {
            if (auth()->user()->department->status != null) {
                return $next($request);
            }
            return abort(403, 'Departamento Bloqueado');
        }
        return redirect()->route('users.edit.department');
    }
}
