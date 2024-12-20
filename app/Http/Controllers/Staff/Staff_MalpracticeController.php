<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamScheduler;
use App\Models\Malpractice;


class Staff_MalpracticeController extends Controller
{
    //
    public function create(Exam $exam, ExamScheduler $exam_schedule)
    {
            return view('staff.malpractice.create', compact('exam','exam_schedule'));
    }

    public function store(Request $request, Exam $exam, ExamScheduler $exam_schedule)
    {

            $formFields = $request->validate([
                'matric_no' => 'required',
                'name' => 'required',
                'message' => 'required'
            ]);

            $formFields['exam_id'] = $exam->id;
            $formFields['exam_schedule_id'] = $exam_schedule->id;
            $formFields['user_id'] = auth()->user()->id;
            $formFields['student_name'] = $request->name;

            

            try
            {
                $new_filename = '';

                if ($request->hasFile('file'))
                {
                        $file = $request->file;

                        $new_filename = time()."-".auth()->user()->id;

                        $new_filename = $new_filename.".".$file->getClientOriginalExtension();

                        $file->storeAs('malpractice', $new_filename);

                        $new_filename = "malpractice/".$new_filename;
                }

                $formFields['file'] = $new_filename;

                $create = Malpractice::create($formFields);
                
                if ($create)
                {
                    $data = [
                        'error' => true,
                        'status' => 'success',
                        'message' => "The Misconduct Incident form has been successfully submitted"
                    ];
                }
                else
                {
                    $data = [
                        'error' => true,
                        'status' => 'fail',
                        'message' => "An error occurred submitting the Malpractice Incidence form"
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
