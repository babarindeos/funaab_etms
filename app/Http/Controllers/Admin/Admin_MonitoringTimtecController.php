<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\TimTecAllocation;
use App\Models\User;

class Admin_MonitoringTimtecController extends Controller
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


            $exam_timtecs_allocations = TimTecAllocation::where('exam_id', $request->get('exam'))
                                    ->orderBy('timtec_member_id','asc')
                                    ->get();

            
        }

        $exams = Exam::orderBy('created_at', 'desc')->get();
        return view('admin.monitoring_timtecs.select_exam_timtecs', compact('exams'))->with(['isPostBack'=>$isPostBack, 
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
        return view('admin.monitoring_timtecs.timtec_observations', compact('exam','timtec_allocations','timtec_member'));
    }

    
}
