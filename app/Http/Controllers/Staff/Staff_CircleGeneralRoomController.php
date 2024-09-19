<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CircleGeneralRoom;
use App\Models\Cell;


class Staff_CircleGeneralRoomController extends Controller
{
    //

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
