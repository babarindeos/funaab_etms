<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamScheduler;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class Staff_ReportController extends Controller
{
    //
    public function create(Exam $exam, ExamScheduler $exam_schedule)
    {
    
        return view('staff.reports.create', compact('exam', 'exam_schedule'));
    }

    public function store(Request $request, Exam $exam, ExamScheduler $exam_schedule)
    {
        $formFields = $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        try
        {
            $new_filename = '';
            $user_id = Auth::user()->id;

            if ($request->hasFile('file'))
            {
                $file = $request->file('file');
                
                $new_filename = time()."-".$user_id;
                $new_filename = $new_filename.".".$file->getClientOriginalExtension();

                $file->storeAs('reports', $new_filename);

                $new_filename =  "reports/".$new_filename;
            }

            $formFields['exam_id'] = $exam->id;
            $formFields['exam_schedule_id'] = $exam_schedule->id;
            $formFields['file'] = $new_filename;
            $formFields['user_id'] = $user_id;

            $create = Report::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => "The Report has been successfully sent"
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => "An error occurred sending the report"
                ];
            }

        }
        catch(\Exception $e)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => $e->getMessage()
            ];
        }

        return redirect()->back()->with($data);
    }
}
