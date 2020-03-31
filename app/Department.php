<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'email', 'status'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function changeStatus()
    {
        return $this->update([
            'status' => $this->status == null ? Carbon::now() : null
        ]);
    }

    public function search(array $request)
    {
        if (count($request)) {
            return $this->where('name', 'LIKE', $request['search'] ? "%{$request['search']}%" : '%%')
                ->where(function ($query) use ($request) {
                    if ($request['status'] == 1) {
                        return $query->where('status', '<=', Carbon::now());
                    } elseif ($request['status'] == 2) {
                        return $query->where('status', null);
                    }
                    return;
                })
                ->orderBy('name')
                ->paginate($request['paginate'] == 'all' ? $this->count('id') : $request['paginate']);
        }
        return $this->where('status', '<=', Carbon::now())
            ->orderBy('name')
            ->get();
    }
}
