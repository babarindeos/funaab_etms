<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Classes\AcademicSessionClass;
use App\Models\InvigilatorAllocation;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\ExamScheduler;

class Staff_InvigilationController extends Controller
{
    //

    public function select_exam()
    {
            // get current academic_session
            $current_semester = AcademicSessionClass::getCurrentSemester();

            $invigilations = null;

            if ($current_semester != null)
            {
                    $invigilations = InvigilatorAllocation::where('semester_id', $current_semester->id)
                                                ->where('invigilator_id', Auth::user()->id)
                                                ->orderBy('exam_day_id', 'asc')
                                                ->orderBy('time_period_id', 'asc')
                                                ->get();
            }

            return view('staff.exams.select_exam', compact('current_semester', 'invigilations'));
    }


    public function get_my_schedule(Request $request)
    {
        $exam = Exam::find($request->exam);

        if (!$exam->semester->current)
        {
            return redirect()->route('staff.dashboard.index');
        }

        $my_invigilations = InvigilatorAllocation::where('exam_id', $exam->id)
                                                ->where('invigilator_id', Auth::user()->id)
                                                ->orderBy('exam_day_id', 'asc')
                                                ->orderBy('time_period_id', 'asc')
                                                ->get();

        

        return view('staff.invigilations.my_schedule', compact('exam', 'my_invigilations'));

    }
}
