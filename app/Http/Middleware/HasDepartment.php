<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Arr;

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
        if (auth()->user()->department == null) {
            return redirect('http://admin.masp.net.br/users/departments?url=' . config('app.url'));
        }
        // Director
        if (auth()->user()->department_id == 1 && count(auth()->user()->roles->all())) {
            if (array_intersect(auth()->user()->roles->pluck()->all(), [1])) {
                return $next($request);
            }
        }
        // Manager
        if (auth()->user()->department_id == 7 && count(auth()->user()->roles->all())) {
            if (array_intersect(auth()->user()->roles->pluck()->all(), [2])) {
                return $next($request);
            }
        }
        // Regular
        if (auth()->user()->department_id == 7) {
            return $next($request);
        }

        return abort(403, 'Usuário não autorizado');
    }
}
