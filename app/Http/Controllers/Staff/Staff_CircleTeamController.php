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
        //$circle = CellUser::with(['cell.users'])->find($circle->id);
        $sortedUsers = $circle->cell->users->sortBy('surname');
        $sortedTeam = $sortedUsers;
    
        return view('staff.circles.team', compact('circle', 'sortedTeam'));
    }
}
