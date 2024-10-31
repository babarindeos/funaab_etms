<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\College;

class Admin_CollegeController extends Controller
{
    //
    public function index(){
        $colleges = College::orderBy('id', 'desc')->paginate(10);
        return view('admin.college.index', compact('colleges'));
    }

    public function create(){
        return view('admin.college.create');
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'name' => 'required|string|unique:colleges,name',
            'code' => 'required|string|unique:colleges,code'
        ]);

        
        /* 
        if ($isCollegeExist){
       
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => 'A College with that name already exist'
            ];
            return redirect()->back()->with($data)->withInput();
        } */

        try
        {
            $create = College::create($formFields);

            if ($create){
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The College has been successfully created'
                ];               
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the College'
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



    public function edit(Request $request, College $college)
    {
        return view('admin.college.edit', compact('college'));
    }

    public function update(Request $request, College $college)
    {
        $formFields = $request->validate([
            'name' => 'required | string',
            'code' => ['required', 'string']
        ]);

       
        try
        {
            $update = $college->update($formFields);

            if ($update){
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'College has been succesfully updated'
                ];
            }else{
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the College'
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

    

    public function confirm_delete(College $college)
    {
        return view('admin.college.confirm_delete', compact('college'));

    }

    public function destroy(Request $request, College $college){

    }

    
}
