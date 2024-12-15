<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Staff;
use App\Models\CourseCoordinator;


class Admin_CourseCoordinatorController extends Controller
{
    //
    public function create(Course $course)
    {
        $staff = Staff::orderBy('surname', 'asc')
                      ->orderBy('firstname', 'asc')
                      ->get();

        $coordinators = CourseCoordinator::where('course_id', $course->id)
                                          ->get();
        
        


        return view('admin.course_coordinators.create', compact('staff', 'course', 'coordinators'));
    }

    public function store(Request $request, Course $course)
    {
        $formFields = $request->validate([
            'staff' => 'required'
        ]);

        $formFields['user_id'] = $request->staff;
        $formFields['course_id'] = $course->id;

        try
        {
            $create = CourseCoordinator::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Coordinator has been successfully added'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'An error occurred added the Coordinator'
                ];
            }

        }
        catch(\Exception $e)
        {
            $data = [
                'error' => true,
                'status' => 'success',
                'message' => $e->getMessage()
            ];
        }

        return redirect()->back()->with($data);

    }

    public function destroy(Request $request, Course $course, CourseCoordinator $coordinator)
    {
        $coordinator->delete();

        return redirect()->back();
    }
}
