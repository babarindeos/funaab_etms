<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CircleGeneralRoom;
use App\Models\Cell;
use App\Models\CellUser;
use Illuminate\Support\Facades\Auth;


class Staff_CircleGeneralRoomController extends Controller
{
    //

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

        return view('staff.circles.general_room', compact('cell', 'circle', 'messages'));

    }

    public function store(Request $request, Cell $cell)
    {
        $formFields = $request->validate([
            'message' => 'required|max:140'
        ]);

        $formFields['sender_id'] = auth()->user()->id;
        $formFields['cell_id'] = $cell->id;

        
        

        try
        {
            $deliver = CircleGeneralRoom::create($formFields);           
        }
        catch(\Exception $e)
        {

        }    
        
        return redirect()->back();

    }
}
