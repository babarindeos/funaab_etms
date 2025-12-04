<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamDay;
use App\Models\Exam;
use App\Models\ExamScheduler;
use App\Models\InvigilatorAllocation;
use App\Models\ChiefAllocation;
use App\Models\TimtecAllocation;

class Manager_ExamDayController extends Controller
{
    public function index(Exam $exam)
    {
        $exam_days = ExamDay::where('exam_id', $exam->id)
                            ->orderby('created_at','desc')->paginate(100);
        
        $scheduled_exams = ExamScheduler::where('exam_id', $exam->id)->get();

       

        return view('manager.exam_days.index', compact('exam_days', 'exam', 'scheduled_exams'));
    }

    public function select_exam_days(Request $request)
    {
        $exam_selected = null;
        $exam_days_data = null;
        $isPostBack = false;
        
        if ($request->input('exam') != '')
        {
            $isPostBack = true;
            $exam_selected = $request->get('exam');


            $exam_days_data = ExamDay::where('exam_id', $request->get('exam'))
                                       ->orderBy('created_at','desc')
                                       ->get();

            
        }

        $exams = Exam::orderBy('created_at', 'desc')->get();
        return view('manager.exam_days_schedules.select_exam_day', compact('exams'))->with(['isPostBack'=>$isPostBack, 
                                                                                     'exam_selected'=>$exam_selected,
                                                                                     'exam_days_data'=>$exam_days_data]);
    }

    public function load_exam_day_schedule(Request $request)
    {
        $request->validate([
            'exam_day' => 'required'
        ]);


        return redirect()->route('manager.exams.exam_days.exam_day_schedule', ['exam_day'=>$request->exam_day]);
        
    }

    public function exam_day_schedule(ExamDay $exam_day)
    {
        $exam_schedules = ExamScheduler::where('exam_day_id', $exam_day->id)
                                        ->orderBy('time_period_id', 'asc')
                                        ->get();    
        
        $invigilators = InvigilatorAllocation::where('exam_day_id', $exam_day->id)
                                               ->get();
        
        $chiefs = ChiefAllocation::where('exam_day_id', $exam_day->id)->get();

        $timtec_members = TimtecAllocation::where('exam_day_id', $exam_day->id)->get();   

        
        //dd($invigilators);
        
        return view('manager.exam_days_schedules.exam_schedule', compact('exam_schedules','exam_day', 'invigilators', 'chiefs', 'timtec_members'));
    }   

}
