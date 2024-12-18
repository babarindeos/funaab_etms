<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\TimTecAllocation;

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

    
}
