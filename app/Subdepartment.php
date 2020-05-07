<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Subdepartment extends Model
{
    protected $fillable = ['department_id','name', 'email','status'];

    /**
     *
     */
    public function department()
    {
        return $this->belongsTo(Department::class)->with(['subdepartments']);
    }

    /**
     *
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function search(array $request = null)
    {
        if (count($request) > 1) {
            return $this->where('name', 'LIKE', $request['search'] ? "%{$request['search']}%" : '%%')
                ->where(function ($query) use ($request) {
                    if ($request['status'] == 1) {
                        return $query->whereNotNull('status');
                    } elseif ($request['status'] == 2) {
                        return $query->where('status', null);
                    }
                    return;
                })
                ->with(['department'])
                ->orderBy('name')
                ->paginate($request['paginate'] == 'all' ? $this->count('id') : $request['paginate']);
        }
        return $this->whereNotNull('status')
            ->where('department_id', $request['department'])
            ->with(['department'])
            ->orderBy('name')
            ->get();
    }
}
