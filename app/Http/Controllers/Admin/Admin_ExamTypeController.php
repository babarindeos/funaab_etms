<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamType;

class Admin_ExamTypeController extends Controller
{
    //
    public function index()
    {
        $exam_types = ExamType::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.exam_types.index', compact('exam_types'));
    }

    public function create()
    {
        return view('admin.exam_types.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|string|unique:exam_types,name'
        ]);

        try
        {
            $create = ExamType::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Exam Type is successfully created'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Exam Type'
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

    public function edit(ExamType $exam_type)
    {
        return view('admin.exam_types.edit', compact('exam_type'));
    }

    public function update(Request $request, ExamType $exam_type)
    {
        $formFields = $request->validate([
            'name' => 'required|string'
        ]);

        try
        {
            $update = $exam_type->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => "The Exam Type has been successfully updated"
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => "An error occurred updating the Exam Type"
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

    public function confirm_delete(ExamType $exam_type)
    {
        return view('admin.exam_types.confirm_delete', compact('exam_type'));
    }

    public function destroy()
    {
        
    }
}
