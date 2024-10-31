<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\AcademicSession;
use Illuminate\Support\Facades\DB;

class Admin_SemesterController extends Controller
{
    //
    public function index()
    {
        $semesters = Semester::orderBy('id', 'desc')->paginate(10);
        return view('admin.semesters.index', compact('semesters'));
    }

    public function create()
    {
        $academic_sessions = AcademicSession::orderBy('id', 'desc')->get();

        return view('admin.semesters.create', compact('academic_sessions'));
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'academic_session' => 'required',
            'semester' => 'required|string'
        ]);
        

        $is_created = Semester::where('academic_session_id', $request->academic_session)
                               ->where('name', $request->semester)->exists();
        if ($is_created)
        {
            $data = [
                'error'=>true,
                'status'=>'fail',
                'message'=> "The Academic Session and Semester already exist"
            ];

            return redirect()->back()->with($data);
        }

        $formFields['academic_session_id'] = $request->input('academic_session');
        $formFields['name'] = $request->input('semester');
        $formFields['current'] = false;

        try
        {
            $create = Semester::create($formFields);

            if ($create)
            {
                $data = [
                    'error'=>true,
                    'status'=>'success',
                    'message'=> "The Semester has been successfully created"
                ];
            }
            else
            {
                $data = [
                    'error'=>true,
                    'status'=>'fail',
                    'message'=> "An error occurred creating the Semester"
                ];
            }
        }
        catch(\Exception $e)
        {
            $data = [
                'error'=>true,
                'status'=>'fail',
                'message'=> $e->getMessage()
            ];
        }

        return redirect()->back()->with($data);
    }

    public function edit(Semester $semester)
    {
        $academic_sessions = AcademicSession::orderBy('id', 'desc')->get();
        return view('admin.semesters.edit', compact('semester', 'academic_sessions'));
    }

    public function update(Request $request, Semester $semester)
    {
        $formFields = $request->validate([
            'academic_session' => 'required',
            'semester' => 'required'
        ]);

        $formFields['academi_session_id'] = $request->input('academic_session');
        $formFields['name'] = $request->input('semester');

        try
        {
            $update = $semester->update($formFields);

            if ($update)
            {
                $data = [
                    'error'=>true,
                    'status'=>'success',
                    'message'=> 'The Semester has been successfully updated'
                ];
            }
            else
            {   
                $data = [
                    'error'=>true,
                    'status'=>'fail',
                    'message'=> "An error occurred updating the Semester"
                ];

            }
        }
        catch(\Exception $e)
        {
                $data = [
                    'error'=>true,
                    'status'=>'fail',
                    'message'=> $e->getMessage()
                ];
        }

        return redirect()->back()->with($data);
    }

    public function confirm_delete(Semester $semester)
    {
        return view('admin.semesters.confirm_delete', compact('semester'));
    }

    public function destroy(Semester $semester)
    {

    }

    public function seton_current_semester(Semester $semester)
    {
        DB::beginTransaction();

        // current Semester
        $is_current = Semester::where('current', true)->first();

        // turn it to false
        if ($is_current != null)
        {
            $is_current->update(['current' => false]);
        }

        // set selected semester to current
        $set_current = $semester->update(['current' => true]);

        if ($set_current)
        {
            DB::commit();
        }
        else
        {
            DB::rollBack();
        }

        return redirect()->back();
    }

    public function setoff_current_semester(Semester $semester)
    {
         
        $semester->update(['current' => false]);
        
        return redirect()->back();
    }
}
