<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\InvigilatorAllocation;
use App\Models\User;

class Admin_MonitoringInvigilatorController extends Controller
{
    //
    public function select_exam_invigilator(Request $request)
    {
            $exam_selected = null;
            $exam_invigilators_allocations = null;
            $isPostBack = false;
            
            if ($request->input('exam') != '')
            {
                $isPostBack = true;
                $exam_selected = $request->get('exam');


                $exam_invigilators_allocations = InvigilatorAllocation::where('exam_id', $request->get('exam'))
                                        ->orderBy('invigilator_id','asc')
                                        ->get();

                
            }

            $exams = Exam::orderBy('created_at', 'desc')->get();
            return view('admin.monitoring_invigilators.select_exam_invigilators', compact('exams'))->with(['isPostBack'=>$isPostBack, 
                                                                                        'exam_selected'=>$exam_selected,
                                                                                        'exam_invigilators_allocations'=>$exam_invigilators_allocations]);
    }


    public function invigilations(Exam $exam, User $invigilator)
    {
         $invigilations = InvigilatorAllocation::where('exam_id', $exam->id)
                                               ->where('invigilator_id', $invigilator->id)
                                               ->orderBy('exam_day_id', 'asc')
                                               ->orderBy('time_period_id', 'asc')
                                               ->get();
        
         return view('admin.monitoring_invigilators.invigilations', compact('invigilations', 'exam', 'invigilator'));

    }
}
