<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
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
        request()->validate([
            'name' => 'required',
            'email' => 'email|nullable',
            'departament' => 'nullable',
            'roles' => 'nullable'
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'username' => request('email') != null ? explode('@', request('email'))[0] : null,
            'department_id' => request('department')['id'],
            'status' => Carbon::now()
        ]);
    }

    public function editDepartment()
    {
        return view('users.department');
    }

    public function update(Request $request, User $user)
    {
        if (request()->has('set_department')) {
            request()->validate([
                'department' => 'required'
            ]);

            $user->update([
                'department_id' => request('department')
            ]);
        }
    }

    public function edit(User $user)
    {
        return view('users.show')->with([
            'user' => User::whereId($user->id)->with(['department'])->first()
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();
    }
}
