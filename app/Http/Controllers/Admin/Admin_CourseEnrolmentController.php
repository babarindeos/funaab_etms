<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseEnrolment;

class Admin_CourseEnrolmentController extends Controller
{
    //
    public function enrolment()
    {

    }

    public function set_enrolment(Request $request, Course $course)
    {

        $formFields = $request->validate([
            'semester_id' => 'required',
            'enrolment' => 'required'
        ]);
        
        
        $formFields['course_id'] = $course->id;
        $formFields['enrolment'] = $request->enrolment;

        try
        {
            //get CourseEnrolment
            $course_enrolment = CourseEnrolment::where('semester_id', $request->semester_id)
                                                ->where('course_id', $course->id)
                                                ->first();
            
            if ($course_enrolment == null)
            {

                $operation = CourseEnrolment::create($formFields);
            }
            else
            {

                $operation = $course_enrolment->update($formFields);

            }


            if ($operation)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'Enrolment has been updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred'
                ];
                
                return redirect()->back()->with($data);
            }

            
        }
        catch(\Exception $e)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => $e->getMessage()
            ];

            return redirect()->back()->with($data);
        }

        return redirect()->back();


    }
}
