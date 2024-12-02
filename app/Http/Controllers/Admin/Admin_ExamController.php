<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Semester;

class Admin_ExamController extends Controller
{
    //
    public function index()
    {
        $exams = Exam::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.exams.index', compact('exams'));
    }

    public function create()
    {
        $semesters = Semester::orderBy('name', 'desc')->get();
        
        return view('admin.exams.create', compact('semesters'));
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'semester' => 'required|string',
            'name' => 'required|string|unique:exams,name',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $formFields['semester_id'] = $request->input('semester');

        try
        {
            $create = Exam::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Exam has been successfully created'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error has occurred creating the Exam'
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

    public function edit(Exam $exam)
    {
        $semesters = Semester::orderBy('name', 'desc')->get();
        return view('admin.exams.edit', compact('exam', 'semesters'));
    }

    public function update(Request $request, Exam $exam)
    {
        $formFields = $request->validate([
            'semester' => 'required|string',
            'name' => 'required|string',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $formFields['semester_id'] = $request->input('semester');

        try
        {
            $update = $exam->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Exam has been successfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error has occurred updating the Exam'
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

    public function confirm_delete(Exam $exam)
    {
        return view('admin.exams.confirm_delete', compact('exam'));
    }

    public function destroy(Exam $exam)
    {

    }
}
