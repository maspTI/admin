<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Rules\CPF;
use Carbon\Carbon;
use App\Department;
use App\Rules\CNPJ;
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
        $departments = new Department;
        $roles = new Role;
        return view('users.create')
            ->with([
                'departments' => $departments->search(),
                'roles' => $roles->search()
            ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'username' => request('email') != null ? explode('@', request('email'))[0] : null,
            'department_id' => request('department')['id'],
            'subdepartment_id' => request('subdepartment') != null ? request('subdepartment')['id'] : request('subdepartment'),
            'cpf_cnpj' => request('cpf_cnpj'),
            'registration_code' => request('registration_code'),
            'role' => request('role'),
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
                'subdepartment' => 'nullable',
                'cpf_cnpj' => ['required', strlen(request('cpf_cnpj')) == 11 ? new CPF : new CNPJ],
                'registration_code' => 'nullable',
                'role' => 'required'
            ]);

            $user->update([
                'department_id' => request('department')['id'],
                'subdepartment_id' => request('subdepartment') != null ? request('subdepartment')['id'] : request('subdepartment'),
                'cpf_cnpj' => request('cpf_cnpj'),
                'registration_code' => request('registration_code'),
                'role' => request('role')
            ]);
            return $user->fresh();
        }

        $this->validateRequest($request);

        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'username' => request('email') != null ? explode('@', request('email'))[0] : null,
            'department_id' => request('department')['id'],
            'subdepartment_id' => request('subdepartment') != null ? request('subdepartment')['id'] : request('subdepartment'),
            'cpf_cnpj' => request('cpf_cnpj'),
            'registration_code' => request('registration_code'),
            'role' => request('role'),
        ]);

        $user->roles()->detach($user->roles->pluck('id')->all());
        $user->roles()->attach(Arr::pluck(request('roles'), 'id'));
    }

    public function edit(User $user)
    {
        $departments = new Department;
        $roles = new Role;
        return view('users.edit')->with([
            'user' => User::whereId($user->id)->with(['department', 'subdepartment', 'roles'])->first(),
            'departments' => $departments->search(),
            'subdepartments' => $user->department->subdepartments,
            'roles' => $roles->search()
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
            'roles' => 'nullable',
            'subdepartment' => 'nullable',
            'cpf_cnpj' => ['required', strlen(request('cpf_cnpj')) == 11 ? new CPF : new CNPJ],
            'registration_code' => 'nullable',
            'role' => 'required'
        ]);
    }
}
