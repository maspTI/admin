<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name','url','status','middlewares'];

    public function getMenus()
    {
        return $this->where('status', '<=', Carbon::now())->orderBy('name')->get();
    }
}
