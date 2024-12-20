<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Classes\AcademicSessionClass;
use App\Models\CourseEnrolment;


class Staff_CourseController extends Controller
{
    //
    public function show(Course $course)
    {
        $current_academic_session = AcademicSessionClass::getCurrentSession();
        
        $current_semester = AcademicSessionClass::getCurrentSemester();

        
        $course_enrolment = CourseEnrolment::where('semester_id', $current_semester->id)
                                            ->where('course_id', $course->id)
                                            ->first();
        
        $semesters_enrolments = CourseEnrolment::where('course_id', $course->id)
                                                ->get();
        

        return view('staff.courses.show', compact('course', 'course_enrolment', 'semesters_enrolments'))->with(['current_session'=>$current_academic_session, 'current_semester'=>$current_semester]);
    }

    public function my_courses()
    {
        $current_academic_session = AcademicSessionClass::getCurrentSession();
        
        $current_semester = AcademicSessionClass::getCurrentSemester();


        return view('staff.courses.my_courses', compact('current_academic_session', 'current_semester'));
    }
}
