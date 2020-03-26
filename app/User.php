<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'department_id','name','email','avatar','username','status',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function search(array $request)
    {
        return $this->where(function ($query) use ($request){
                $query->where('name', 'LIKE', $request['search'] != null ? "%{$request['search']}%" : '%%')
                ->orWhere('email',  'LIKE', $request['search'] != null ? "%{$request['search']}%" : '%%')
                ->orWhere('username',  'LIKE', $request['search'] != null ? "%{$request['search']}%" : '%%');
            })
            ->orWhere(function($query) use ($request) {
                if($request['status'] == 1){
                    return $query->where('status', '<=', Carbon::now());
                } elseif($request['status'] == 2) {
                    return $query->whereIsNull('status');
                }
                return;
            })
            ->orWhereHas('department', function($query) use ($request){
                $query->where('name', $request['search'] != null ? "%{$request['search']}%" : '%%');
            })
            ->where('id', '<>', auth()->user()->id)
            ->orderBy('name')
            ->paginate($request['paginate'] == 'all' ? $this->count('id') : $request['paginate']);;
    }
}
