<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'department_id', 'subdepartment_id','name','email','avatar','username','status','role','cpf_cnpj','registration_code'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function subdepartment()
    {
        return $this->belongsTo(Subdepartment::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function changeStatus()
    {
        return $this->update([
            'status' => $this->status == null ? Carbon::now() : null
        ]);
    }

    public function search(array $request)
    {
        return $this->where(function ($query) use ($request) {
            $query->where('name', 'LIKE', $request['search'] ? "%{$request['search']}%" : '%%')
                    ->orWhere('email', 'LIKE', $request['search'] ? "%{$request['search']}%" : '%%')
                    ->orWhere('username', 'LIKE', $request['search'] ? "%{$request['search']}%" : '%%');
        })
            ->where(function ($query) use ($request) {
                if ($request['status'] == 1) {
                    return $query->where('status', '<=', Carbon::now());
                } elseif ($request['status'] == 2) {
                    return $query->where('status', null);
                }
                return;
            })
            ->where(function ($query) use ($request) {
                if ($request['department'] != null) {
                    return $query->whereHas('department', function ($query) use ($request) {
                        if ($request['department'] != 'all') {
                            return $query->where('name', 'LIKE', $request['department']);
                        }
                        return $query->where('name', 'LIKE', '%%');
                    });
                }
                return $query->whereDoesntHave('department');
            })
            ->orderBy('name')
            ->with(['department'])
            ->paginate($request['paginate'] == 'all' ? $this->count('id') : $request['paginate']);
    }
}
