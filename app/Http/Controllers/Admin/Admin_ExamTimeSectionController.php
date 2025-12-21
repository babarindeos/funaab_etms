<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamTimeSection;

class Admin_ExamTimeSectionController extends Controller
{
    //

    public function index()
    {
        $exam_time_sections = ExamTimeSection::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.exam_time_sections.index', compact('exam_time_sections'));
    }

    public function create()
    {
        return view('admin.exam_time_sections.create');

    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|string|unique:exam_time_sections,name'
        ]);

        try
        {
            $create = ExamTimeSection::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Exam Time Section is successfully created'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Exam Time Section'
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


    public function edit(ExamTimeSection $exam_time_section)
    {
        return view('admin.exam_time_sections.edit', compact('exam_time_section'));
    }


    public function update(Request $request, ExamTimeSection $exam_time_section)
    {
        $formFields = $request->validate([
            'name' => 'required|string'
        ]);

        try
        {
            $update = $exam_time_section->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => "The Exam Time Section has been successfully updated"
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => "An error occurred updating the Exam Time Section"
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
