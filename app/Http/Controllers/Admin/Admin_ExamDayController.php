<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamDay;
use App\Models\Exam;

class Admin_ExamDayController extends Controller
{
    //
    public function index(Exam $exam)
    {
        $exam_days = ExamDay::where('exam_id', $exam->id)
                            ->orderby('created_at','desc')->paginate(100);

        return view('admin.exam_days.index', compact('exam_days', 'exam'));
    }

    public function create(Exam $exam)
    {
        return view('admin.exam_days.create', compact('exam'));
    }

    public function store(Request $request, Exam $exam)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'date' => 'required'
        ]);

        $formFields['exam_id'] = $exam->id;

        try
        {
            $create = ExamDay::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Exam Day has been successfully created'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Exam Day'
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


    public function edit(Exam $exam, ExamDay $day)
    {
        return view('admin.exam_days.edit', compact('exam', 'day'));
    }

    public function update(Request $request, Exam $exam, ExamDay $day)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'date' => 'required'
        ]);

        $formFields['exam_id'] = $exam->id;

        try
        {
            $update = $day->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Exam Day has been successfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'An error occurred updating the Exam Day'
                ];
            }

        }
        catch(\Exception $e)
        {
            $data = [
                'error' => true,
                'status' => 'success',
                'message' => $e->getMessage()
            ];
        }

        return redirect()->back()->with($data);
    }

    public function confirm_delete(Exam $exam, ExamDay $day)
    {
            return view('admin.exam_days.confirm_delete', compact('exam', 'day'));
    }

    public function destroy(Exam $exam, ExamDay $day)
    {
        
    }

}
