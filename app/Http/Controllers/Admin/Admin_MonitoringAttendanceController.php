<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Exam;
use App\Models\Attendance;


class Admin_MonitoringAttendanceController extends Controller
{
    //
    public function select_exam_attendance(Request $request)
    {
        $exam_selected = null;
        $isPostBack = false;
        $exam_attendance_register = null;


        if ($request->input('exam') != '')
        {
            $isPostBack = true;
            $exam_selected = $request->get('exam');


            $exam_attendance_register = Attendance::where('exam_id', $request->get('exam'))
                                        ->orderBy('id','asc')
                                        ->get();

            
        }


        $exams = Exam::orderBy('created_at', 'desc')->get();
        return view('admin.monitoring_attendance.select_exam_attendance', compact('exams'))->with(['isPostBack'=>$isPostBack, 
                                                                                    'exam_selected'=>$exam_selected,
                                                                                    'exam_attendance_register'=>$exam_attendance_register]);
    }
}
