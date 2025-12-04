<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Exam;
use App\Models\Course;
use App\Models\ExamScheduler;

class Manager_CourseInvigilationController extends Controller
{
    //
    public function index()
    {
        $exams = Exam::orderBy('created_at', 'desc')->paginate(20);
        $scheduled_day_exams = [];

        return view('manager.course_invigilation.index', compact('exams', 'scheduled_day_exams'));
    }


    public function fetch_course(Request $request)
    {
        $course_code = $request->query('course_code');
        
        $courses = Course::where('code', 'LIKE', "%{$course_code}%")
                          ->orderBy('title', 'asc')
                          ->get();

        $course_options = '';

        foreach($courses as $course)
        {
            $course_options .= "<div class='py-3 border-b border-gray-500 cursor-pointer' id='".$course->id."'>".$course->code." - ".$course->title."</div>";
        }

        //dd($course_options);

        return $course_options;
    }



    public function invigilation(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'exam' => 'required'
        ]);

         $exams = Exam::orderBy('created_at', 'desc')->paginate(20);
       

         $scheduled_day_exams = ExamScheduler::where('exam_id', $request->exam)
                                         ->where('course_id', $request->course_id)
                                         ->orderBy('created_at', 'desc')
                                         ->get();


        
       //return redirect()->back()->with('scheduled_day_exams', $scheduled_day_exams);
       return view('manager.course_invigilation.index', compact('exams', 'scheduled_day_exams'));

    }
}
