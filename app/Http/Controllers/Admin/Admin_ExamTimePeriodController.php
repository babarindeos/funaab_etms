<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamTimePeriod;

class Admin_ExamTimePeriodController extends Controller
{
    //
    public function index()
    {
        $exam_time_periods = ExamTimePeriod::orderBy('created_at','desc')->paginate(20);

        return view('admin.exam_time_periods.index', compact('exam_time_periods'));
    }

    public function create()
    {
        return view('admin.exam_time_periods.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|string|unique:exam_time_periods,name',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        try
        {
            $create = ExamTimePeriod::create($formFields);

            if ($create)
            {
                $data = [
                    'error'=> true,
                    'status' => 'success',
                    'message' => 'The Exam Time Period has been successfully created'
                ];
            }
            else
            {
                $data = [
                    'error'=> true,
                    'status' => 'fail',
                    'message' => 'An error has occurred creatimg the Exam Time Period'
                ];
            }
        }
        catch(\Exception $e)
        {
                $data = [
                    'error'=> true,
                    'status' => 'success',
                    'message' => $e->getMessage()
                ];
        }

        return redirect()->back()->with($data);
    }

    public function edit(ExamTimePeriod $exam_time_period)
    {
        return view('admin.exam_time_periods.edit', compact('exam_time_period'));
    }

    public function update(Request $request, ExamTimePeriod $exam_time_period)
    {
        $formFields = $request->validate([
            'name'=> 'required|string',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        try
        {
            $update = $exam_time_period->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => "The Exam Time Period has been successfully updated"
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => "An error occurred updating the Exam Time Period"
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

    public function confirm_delete(ExamTimePeriod $exam_time_period)
    {
        return view('admin.exam_time_periods.confirm_delete', compact('exam_time_period'));
    }

    public function destroy(ExamTimePeriod $exam_time_period)
    {
        
    }
}
