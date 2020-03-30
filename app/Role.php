<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'status'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function search(array $request)
    {
        if (count($request)) {
            return;
        }
        return $this->where('status', '<=', Carbon::now())
            ->orderBy('name')
            ->get();
    }
}
