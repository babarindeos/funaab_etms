<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamDay;
use App\Models\Course;
use App\Models\Venue;
use App\Models\ExamTimePeriod;
use App\Models\ExamScheduler;
use Illuminate\Support\Facades\Auth;
use App\Models\ExamType;

class Manager_ExamSchedulerController extends Controller
{
    //
    public function scheduler(ExamDay $exam_day)
    {
        $courses = Course::orderBy('code', 'asc')->get();
        $exam_types = ExamType::orderBy('name', 'asc')->get();
        $venues = Venue::orderBy('name', 'asc')->get();
        $exam_time_periods = ExamTimePeriod::orderBy('name', 'asc')->get();


        $scheduled_day_exams = ExamScheduler::where('exam_day_id', $exam_day->id)
                                            ->orderBy('created_at', 'desc')
                                            ->get();


        $scheduled_exams = ExamScheduler::where('exam_id', $exam_day->exam->id)
                                         ->orderBy('created_at', 'desc')
                                         ->get();

       

        return view('manager.exam_scheduler.scheduler', compact('exam_day'))
                    ->with(['courses'=>$courses,
                            'exam_types'=>$exam_types, 
                            'venues'=>$venues, 
                            'exam_time_periods'=>$exam_time_periods,
                            'scheduled_day_exams'=>$scheduled_day_exams,
                            'scheduled_exams'=>$scheduled_exams
                        ]);
    }

}
