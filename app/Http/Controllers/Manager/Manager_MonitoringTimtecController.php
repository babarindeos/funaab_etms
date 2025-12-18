<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Exam;
use App\Models\TimtecAllocation;
use App\Models\User;

class Manager_MonitoringTimtecController extends Controller
{
    //
    public function select_exam_timtec(Request $request)
    {
        $exam_selected = null;
        $exam_timtecs_allocations = null;
        $isPostBack = false;
        
        if ($request->input('exam') != '')
        {
            $isPostBack = true;
            $exam_selected = $request->get('exam');


            $exam_timtecs_allocations = TimtecAllocation::where('exam_id', $request->get('exam'))   
                                                         ->groupBy('timtec_member_id')                                 
                                                         ->orderBy('timtec_member_id','asc')
                                                         ->get();
                                    

            
        }

        $exams = Exam::orderBy('created_at', 'desc')->get();
        return view('manager.monitoring_timtecs.select_exam_timtecs', compact('exams'))->with(['isPostBack'=>$isPostBack, 
                                                                                    'exam_selected'=>$exam_selected,
                                                                                    'exam_timtecs_allocations'=>$exam_timtecs_allocations]);
    }


    public function timtec_observation(Exam $exam, User $timtec_member)
    {
        
        $timtec_allocations =  TimtecAllocation::where('exam_id', $exam->id)
                                              ->where('timtec_member_id', $timtec_member->id)
                                              ->orderBy('exam_day_id', 'asc')
                                              ->orderBy('time_period_id', 'asc')
                                              ->get();
        return view('manager.monitoring_timtecs.timtec_observations', compact('exam','timtec_allocations','timtec_member'));
    }

}
