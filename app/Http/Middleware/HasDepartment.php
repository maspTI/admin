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

        if (in_array(auth()->user()->department->id, [1,7,17])) {
            return $next($request);
        }

        return abort(403, 'Usuário não autorizado');
    }
}
