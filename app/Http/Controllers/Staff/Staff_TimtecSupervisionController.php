<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Classes\AcademicSessionClass;
use App\Models\TimtecAllocation;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\ExamScheduler;
use App\Models\RemunerationRate;
use App\Models\InvigilatorAllocation;
use App\Models\Attendance;


class Staff_TimtecSupervisionController extends Controller
{
    //
    public function select_exam()
    {
            // get current academic_session
            $current_semester = AcademicSessionClass::getCurrentSemester();

            $timtec_supervisions = null;

            if ($current_semester != null)
            {
                    $timtec_supervisions = TimtecAllocation::where('semester_id', $current_semester->id)
                                                        ->where('timtec_member_id', Auth::user()->id)
                                                        ->orderBy('exam_day_id', 'asc')
                                                        ->orderBy('time_period_id', 'asc')
                                                        ->get();
            }


            return view('staff.timtec_supervisions.select_exam', compact('current_semester', 'timtec_supervisions'));
    }


    public function get_my_schedule(Request $request)
    {
        $exam = Exam::find($request->exam);

        if (!$exam->semester->current)
        {
            return redirect()->route('staff.dashboard.index');
        }

        $my_supervisions = TimtecAllocation::where('exam_id', $exam->id)
                                                ->where('timtec_member_id', Auth::user()->id)
                                                ->orderBy('exam_day_id', 'asc')
                                                ->orderBy('time_period_id', 'asc')
                                                ->get();

                    
        

        return view('staff.timtec_supervisions.my_schedule', compact('exam', 'my_supervisions'));

    }

    public function attendance(TimtecAllocation $supervision)
    {
        $schedules = ExamScheduler::where('exam_day_id', $supervision->exam_day_id)
                                 ->get();
        $attendance_options = RemunerationRate::orderby('id', 'asc')->get();

        $attendances = Attendance::where('exam_day_id', $supervision->exam_day_id)->get();

        return view('staff.timtec_supervisions.attendance', compact('supervision', 'schedules', 'attendance_options', 'attendances'));
    }

    public function store_attendance(Request $request, TimtecAllocation $supervision)
    {

            
            $attendance = RemunerationRate::find($request->attendance);
            $invigilation_allocation = InvigilatorAllocation::find($request->invigilation_id);            


            $formFields['academic_session_id'] = $invigilation_allocation->academic_session_id;
            $formFields['semester_id'] = $invigilation_allocation->semester_id;
            $formFields['exam_id'] = $invigilation_allocation->exam_id;
            $formFields['exam_day_id'] = $invigilation_allocation->exam_day_id;
            $formFields['invigilator_id'] = $invigilation_allocation->invigilator_id;
            $formFields['invigilator_allocation_id'] = $invigilation_allocation->id;
            $formFields['supervisor_allocation_id'] = $supervision->id;
            $formFields['venue_id'] = $invigilation_allocation->venue_id;
            $formFields['time_period_id'] = $invigilation_allocation->time_period_id;
            $formFields['supervisor_id'] = $supervision->timtec_member_id;

            $formFields['attendance'] = $attendance->name;
            $formFields['attendance_amount'] = $attendance->amount;
            $formFields['attendance_point'] = $attendance->point;

            
            try
            {
                Attendance::create($formFields);
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
