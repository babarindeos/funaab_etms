<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;    
use App\Models\ExamScheduler;
use App\Models\AvailabilityList;
use App\Models\StaffStatus;
use App\Models\Staff;

class Admin_AllocationStatisticController extends Controller
{
    //
    public function select_exam()
    {
        $exams = Exam::orderBy('created_at', 'desc')->get();

        return view('admin.allocation_statistics.select_exam', compact('exams'));
    }

    public function index(Exam $exam)
    {
        // exam schedules count
        $exam_schedules_count = ExamScheduler::where('exam_id', $exam->id)->count();

        // exam schedules 
        $exam_schedules = ExamScheduler::where('exam_id', $exam->id)->get();

        // availability count
        $availability_count = AvailabilityList::count();

        $professor_status = StaffStatus::where('name', 'Professor')->first();

        $professor_count = $professor_status->staff->count();

        $total_staff_count = Staff::count();

        $other_staff_except_prof = $total_staff_count - $professor_count;



        // exam schedule total invigilators
        $exam_schedule_total_invigilators = 0;

        foreach($exam_schedules as $exam_schedule)
        {
            $venue_max_invigilators = $exam_schedule->venue->max_invigilators;

            $exam_schedule_total_invigilators += $venue_max_invigilators;

            // chjeck for support venue for this schedule
            if ($exam_schedule->support_venues->count())
            {
                foreach($exam_schedule->support_venues as $support_venue)
                {
                    $support_venue_max_invigilators = $support_venue->venue->max_invigilators;

                    $exam_schedule_total_invigilators += $support_venue_max_invigilators;

                }
               
            }
            
        }




        return view('admin.allocation_statistics.index', compact('exam',
                                                                 'exam_schedule_total_invigilators',
                                                                 'exam_schedules_count',
                                                                 'availability_count',
                                                                 'professor_count',
                                                                 'other_staff_except_prof'));
    }
}
