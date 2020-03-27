<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
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
