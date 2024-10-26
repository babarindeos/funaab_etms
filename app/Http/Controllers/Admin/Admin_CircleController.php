<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cell;
use App\Models\CellUser;
use App\Models\Staff;


class Admin_CircleController extends Controller
{
    //
    public function show(Cell $cell)
    {
        
        $circles = Cell::where('parent', $cell->id)->get();
        return view('admin.circles.show', compact('circles', 'cell'));
    }

    public function add_user(Request $request, Cell $cell)
    {
        $formFields = $request->validate([
            'fileno' => 'required',            
        ]);

        $staff = Staff::where('fileno', $request->input('fileno'))->first();

        $user_exist_in_circle = CellUser::where('cell_id', $cell->id)
                                        ->where('user_id', $staff->user_id)->exists();
        
        if($user_exist_in_circle )
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => 'The Staff is already a member of the Circle.'
            ];

            return redirect()->back()->with($data);
        }

        try
        {
            $formFields['cell_id'] = $cell->id;
            $formFields['user_id'] = $staff->user_id;
            $formFields['role'] = $request->input('role');

            // or formFields['role'] = $request->role
           
            $add_user = CellUser::create($formFields);

            if ($add_user)
            {
                $data = [
                    'error'=> true,
                    'status' => 'success',
                    'message'=> 'User has been succesfully added to Circle'
                ];
            }
            else{
                throw new \Exception("adding user failed");
            }
        }
        catch(\Exception $e)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => $e->getMessage()
            ];
        }

        return redirect()->back()->with($data);
    }
}
