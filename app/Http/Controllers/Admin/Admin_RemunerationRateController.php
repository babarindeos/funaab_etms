<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Admin_RemunerationRateController extends Controller
{
    //
    public function index()
    {
        return view('admin.remuneration_rates.index', compact());
    }
}
