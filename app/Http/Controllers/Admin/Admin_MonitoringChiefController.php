<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChiefAllocation;
use App\Models\Exam;

class Admin_MonitoringChiefController extends Controller
{
    //
    public function select_exam_chief(Request $request)
    {
            $exam_selected = null;
            $exam_chiefs_allocations = null;
            $isPostBack = false;
            
            if ($request->input('exam') != '')
            {
                $isPostBack = true;
                $exam_selected = $request->get('exam');


                $exam_chiefs_allocations = ChiefAllocation::where('exam_id', $request->get('exam'))
                                        ->orderBy('chief_id','asc')
                                        ->get();

                
            }

            $exams = Exam::orderBy('created_at', 'desc')->get();
            return view('admin.monitoring_chiefs.select_exam_chiefs', compact('exams'))->with(['isPostBack'=>$isPostBack, 
                                                                                        'exam_selected'=>$exam_selected,
                                                                                        'exam_chiefs_allocations'=>$exam_chiefs_allocations]);
    }
}
