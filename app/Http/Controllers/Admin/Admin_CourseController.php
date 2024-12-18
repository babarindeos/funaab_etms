<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\College;
use App\Models\Department;
use App\Models\CourseEnrolment;

use App\Http\Classes\AcademicSessionClass;


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
        $departments = Department::orderBy('name', 'desc')->get();
        return view('admin.courses.create', compact('colleges', 'departments'));
    }

    public function store(Request $request)
    {
        
        $formFields = $request->validate([
            'department' => 'required|string',
            'title' => 'required|string|unique:courses,title',
            'code' => ['required', 'string', 'unique:courses,code']
        ]);

        $formFields['department_id'] = $request->input('department');

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
        $departments = Department::orderBy('name', 'desc')->get();
        return view('admin.courses.edit', compact('course', 'departments'));
    }

    public function update(Request $request, Course $course)
    {
        
        $formFields = $request->validate([
            'department' => 'required|string',
            'title' => 'required|string',
            'code' => ['required', 'string']
        ]);

        $formFields['department_id'] = $request->input('department');

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

    public function get_departments_by_college(Request $request)
    {
       
    }

    public function show(Course $course)
    {
        $current_academic_session = AcademicSessionClass::getCurrentSession();
        
        $current_semester = AcademicSessionClass::getCurrentSemester();

        
        $course_enrolment = CourseEnrolment::where('semester_id', $current_semester->id)
                                            ->where('course_id', $course->id)
                                            ->first();
        
        $semesters_enrolments = CourseEnrolment::where('course_id', $course->id)
                                                ->get();
        

        return view('admin.courses.show', compact('course', 'course_enrolment', 'semesters_enrolments'))->with(['current_session'=>$current_academic_session, 'current_semester'=>$current_semester]);
    }
}
