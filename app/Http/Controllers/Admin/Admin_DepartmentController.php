<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\College;
use App\Models\Department;

class Admin_DepartmentController extends Controller
{
    //
    public function index(){
        $departments = Department::orderBy('name', 'asc')->paginate(2);
        return view('admin.departments.index', compact('departments'));
    }

    public function create(){
        
        $colleges = College::orderBy('name', 'asc')->get();
        return view('admin.departments.create', compact('colleges'));
    }

    public function store(Request $request){
        
        $formFields = $request->validate([
            'college' => 'required',
            'name' => 'required|string|unique:departments,name',
            'code' => ['required','string','unique:departments,code']
        ]);

        $formFields['college_id'] = $formFields['college'];

        try{
            $create = Department::create($formFields);

            if ($create){
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Department has been successfully created'
                ];
            }else{
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Department'
                ];
            }
    
        }catch(\Exception $e)
        {
            $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => $e->getMessage()
            ];
        }       

        
        return redirect()->back()->with($data);
        
    }


    public function edit(Department $department){
       
        $colleges = College::orderBy('name', 'asc')->get();
        

        return view('admin.departments.edit', compact('colleges', 'department'));
    }

    public function update(Request $request, Department $department){
       
        $formFields = $request->validate([
            'college' => 'required',
            'name' => ['required', 'string'],
            'code' => 'required | string'
        ]);


        $formFields['college_id'] = $formFields['college'];

        try
        {
            $update = $department->update($formFields);

            if ($update){
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Department has been successfully updated'
                ];
            }else{
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Department'
                ];
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

    public function confirm_delete(Department $department)
    {
        return view('admin.departments.confirm_delete', compact('department'));
    }

    public function destroy(Department $department)
    {

    }

    public function get_departments_by_college( College $college)
    {

    }

    public function show(Department $department)
    {
        return view('admin.departments.show')->with(['department'=>$department]);
    }
}
