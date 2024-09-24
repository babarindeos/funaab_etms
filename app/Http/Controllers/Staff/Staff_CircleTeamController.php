<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cell;
use App\Models\CellUser;
use Illuminate\Support\Facades\Auth;

class Staff_CircleTeamController extends Controller
{
    //
    public function team(CellUser $circle)
    {
              
        return view('staff.circles.team', compact('circle'));
    }
}
