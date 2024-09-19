<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CellUser;
use App\Models\Cell;
use App\Models\CircleGeneralRoom;

class Staff_CircleController extends Controller
{
    //
    public function index()
    {
        $circles = CellUser::where('user_id', Auth::user()->id)->get();
        
        return view('staff.circles.index', compact('circles'));
    }

    public function general_room(CellUser $circle)
    {
        if ($circle == null)
        {
            return redirect()->route('staff.circles.index');
        }

        if ($circle->user_id != Auth::id())
        {
            return redirect()->back();
        }

        $cell = Cell::find($circle->cell_id);

        $messages = CircleGeneralRoom::where('cell_id', $circle->cell_id)
                                       ->orderBy('created_at', 'desc')
                                       ->take(100)
                                       ->paginate(20);

        return view('staff.circles.general_room', compact('cell', 'messages'));

    }
}
