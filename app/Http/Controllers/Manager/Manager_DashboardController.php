<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Manager_DashboardController extends Controller
{
    //
    public function index()
    {
        return view('manager.dashboard.index');
    }
}
