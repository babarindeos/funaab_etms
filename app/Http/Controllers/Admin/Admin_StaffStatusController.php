<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StaffStatus;

class Admin_StaffStatusController extends Controller
{
    //
    public function index()
    {
        $statuses = StaffStatus::orderBy('name', 'desc')->paginate(20);

        return view('admin.statuses.index', compact('statuses'));
    }

    public function create()
    {
        return view('admin.statuses.create');
    }

    public function store(Request $request )
    {
        $formFields = $request->validate([
            'name'=> 'required|string|unique:staff_statuses,name'
        ]);

        try
        {
            $create = StaffStatus::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Staff Status has been successfully created'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Staff Status'
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

    public function edit(StaffStatus $status)
    {
        return view('admin.statuses.edit', compact('status'));
    }

    public function update(Request $request, StaffStatus $status)
    {
        $formFields = $request->validate([
            'name' => 'required|string'
        ]);


        try
        {
            $update = $status->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Staff Status has been successfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Staff Status'
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

    public function confirm_delete(StaffStatus $status)
    {
        return view('admin.statuses.confirm_delete', compact('status'));
    }

    public function destroy(StaffStatus $status)
    {
        
    }
}
