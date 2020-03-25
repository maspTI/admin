<?php

namespace App\Http\Controllers;

use App\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index')
            ->with(['menus' => Menu::where('status', '<=', Carbon::now())->orderBy('name')->get()]);
    }
}
