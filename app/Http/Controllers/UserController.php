<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Mail\VerifyUserDepartment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        if (request()->wantsJson()) {
            $users = new User;
            return $users->search(request()->all());
        }
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'username' => request('email') != null ? explode('@', request('email'))[0] : null,
            'department_id' => request('department')['id'],
            'status' => Carbon::now()
        ]);

        $user->roles()->attach(Arr::pluck(request('roles'), 'id'));
    }

    public function editDepartment()
    {
        return view('users.department');
    }

    public function update(Request $request, User $user)
    {
        if (request()->has('change_status')) {
            $user->changeStatus();
            return $user->fresh();
        }

        if (request()->has('set_department')) {
            request()->validate([
                'department' => 'required',
                'subdepartment' => 'nullable'
            ]);

            $user->update([
                'department_id' => request('department')['id'],
                'subdepartment_id' => request('subdepartment') != null ? request('subdepartment')['id'] : request('subdepartment')
            ]);
            return $user->fresh();
        }

        $this->validateRequest($request);

        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'username' => request('email') != null ? explode('@', request('email'))[0] : null,
            'department_id' => request('department')['id'],
        ]);

        $user->roles()->detach($user->roles->pluck('id')->all());
        $user->roles()->attach(Arr::pluck(request('roles'), 'id'));
    }

    public function edit(User $user)
    {
        return view('users.edit')->with([
            'user' => User::whereId($user->id)->with(['department', 'roles'])->first()
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();
    }

    public function validateRequest(Request $request, User $user = null)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'email|nullable',
            'departament' => 'nullable',
            'roles' => 'nullable'
        ]);
    }
}
