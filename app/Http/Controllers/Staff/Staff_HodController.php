<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Staff_HodController extends Controller
{
    //
    public function index()
    {
        $department = Auth::user()->hod->department;
        return view('staff.hod.index')->with(['department'=>$department]);
    }
}
