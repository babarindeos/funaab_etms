<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Staff;
use App\Models\Hod;

class Admin_HodController extends Controller
{
    public function index()
    {
        $hods = Hod::orderBy('department_id', 'asc')
                    ->paginate(20);
        return view('admin.hods.index', compact('hods'));
    }


    //
    public function create(Department $department)
    {
        $staff = Staff::orderBy('surname', 'asc')
                        ->orderBy('firstname')
                        ->get();
        
        
        return view('admin.hods.create', compact('department', 'staff'));
    }

    public function store(Request $request, Department $department)
    {
        $formFields = $request->validate([
            'staff' => 'required|unique:hods,user_id'
        ]);

        $formFields['department_id'] = $department->id;
        $formFields['user_id'] = $request->staff;

        try
        {
            Hod::create($formFields);
        }
        catch(\Exception $e)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => $e.getMessage()
            ];

            return redirect()->back()->with($data);
        }

        return redirect()->route('admin.departments.index');
    }

    public function edit(Department $department)
    {
        $staff = Staff::orderBy('surname', 'asc')
                      ->orderBy('firstname', 'asc')
                      ->get();
                      
        return view('admin.hods.edit', compact('staff', 'department'));
    }

    public function update(Request $request, Department $department, Hod $hod)
    {
        
        $formFields = $request->validate([
            'staff' => 'required'
        ]);

        $formFields['user_id'] = $request->staff;
        //$formFields['department_id'] = $request->

        try
        {
            $update = $hod->update($formFields);

            $data = [
                'error'=> true,
                'status' => 'success',
                'message' => 'HOD has been successfully updated'
            ];
            
        }
        catch(\Exception $e)
        {
            $data = [
                'error'=>true,
                'status' => 'fail',
                'message' => $e.getMessage()
            ];

            
        }

        return redirect()->back()->with($data);
    }

    
}
