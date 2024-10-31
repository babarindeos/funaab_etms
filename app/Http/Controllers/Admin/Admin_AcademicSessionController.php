<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicSession;
use Illuminate\Support\Facades\DB;

class Admin_AcademicSessionController extends Controller
{
    //
    public function index()
    {
        $academic_sessions = AcademicSession::orderBy('id','desc')->paginate(10);
        return view('admin.academic_sessions.index', compact('academic_sessions'));
    }

    public function create()
    {
        return view('admin.academic_sessions.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|string|unique:academic_sessions,name'
        ]);

        $formFields['current'] = false;

        try
        {
            $create = AcademicSession::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => "The Academic Session {$request->name} has been successfully created"
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => "An error occurred creating the session {$request->name}"
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

    public function edit(Request $request, AcademicSession $academic_session)
    {
        return view('admin.academic_sessions.edit', compact('academic_session'));
    }

    public function update(Request $request, AcademicSession $academic_session)
    {
        $formFields = $request->validate([
            'name' => 'required|string'
        ]);


        try
        {
            $update = $academic_session->update($formFields);

            if ($update)
            {   
                $data = [
                    'error'=>true,
                    'status'=>'success',
                    'message'=> 'The Academic Session has been successfully updated'
                ];
            }
            else
            {   
                $data = [
                    'error'=>true,
                    'status'=>'fail',
                    'message'=> 'An error occurred updating the Academic Session'
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


    public function confirm_delete(AcademicSession $academic_session)
    {
        return view('admin.academic_sessions.confirm_delete', compact('academic_session'));
    }

    public function destroy(AcademicSession $academic_session)
    {

    }

    public function seton_current_session(AcademicSession $academic_session)
    {
        DB::beginTransaction();

        // look for the current session and turn it off
        $is_current = AcademicSession::where('current', true)->first();


        // turn current Academic Session off
        if ($is_current != null)
        {
            $is_current->update(['current' => false]);            
        }

        // set new Academic Session On
        $set_current = $academic_session->update(['current'=>true]);

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

    public function setoff_current_session(AcademicSession $academic_session)
    {
         $academic_session->update(['current'=>false]);
         return redirect()->back();
    }
}
