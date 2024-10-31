<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\College;
use App\Models\Department;

class Admin_CourseController extends Controller
{
    //
    public function index()
    {
        $courses = Course::orderBy('id', 'desc')->paginate(20);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $colleges = College::orderBy('name', 'desc')->get();
        return view('admin.courses.create', compact('colleges'));
    }

    public function store(Request $request)
    {
        
        $formFields = $request->validate([
            'title' => 'required|string|unique:courses,title',
            'code' => ['required', 'string', 'unique:courses,code']
        ]);

        try
        {
            $create = Course::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Course has been successfully created'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Course'
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

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $formFields = $request->validate([
            'title' => 'required|string',
            'code' => ['required', 'string']
        ]);

        try
        {
            $update = $course->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Course has been successfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Course'
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

    public function confirm_delete(Course $course)
    {
        return view('admin.courses.confirm_delete', compact('course'));

    }

    public function destroy()
    {

    }

    public function get_departments_by_college(Request $request, $college)
    {
       //  $request->query('category_type');    -- by GET 
       $departments= Department::where('college_id', $college->id)->get();

       $data = "<option value=''>-- Select Department --</option>";

       foreach( $departments as $department)
       {
            $data .= "<option value='{$department->id}'>{$department->name}</option>"; 
       }

       return $data;
    }
}
