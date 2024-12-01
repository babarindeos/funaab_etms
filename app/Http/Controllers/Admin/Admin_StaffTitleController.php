<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StaffTitle;

class Admin_StaffTitleController extends Controller
{
    //
    public function index()
    {
        $titles = StaffTitle::orderBy('title', 'desc')->paginate(20);
        return view('admin.titles.index', compact('titles'));
    }

    public function create()
    {
        return view('admin.titles.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required|string|unique:staff_titles,title'
        ]);

        
        try
        {
            $create = StaffTitle::create($formFields);

            if ($create)
            {
                $data = [
                    'error'=>true,
                    'status'=> 'success',
                    'message'=> "The Staff Title has been successfully created"
                ];
            }
            else
            {
                $data = [
                    'error'=>true,
                    'status'=> 'fail',
                    'message'=> "An error occurred creating the Staff Title"
                ];
            }
        }
        catch(\Exception $e)
        {
            $data = [
                'error'=>true,
                'status'=> 'fail',
                'message'=> $e->getMessage()
            ];
        }

        return redirect()->back()->with($data);
    }

    public function edit(StaffTitle $title)
    {
        return view('admin.titles.edit', compact('title'));
    }

    public function update(Request $request, StaffTitle $title)
    {
        $formFields = $request->validate([
            'title' => 'required|string'
        ]);

        try
        {
            $update = $title->update($formFields);
            if ($update)
            {
                $data = [
                    'error'=>true,
                    'status'=> 'success',
                    'message'=> "The Staff Title has been successfully updated"
                ];
            }
            else
            {
                $data = [
                    'error'=>true,
                    'status'=> 'fail',
                    'message'=> "An error occurred updating the Staff Title"
                ];
            }
           
        }
        catch(\Exception $e)
        {
            $data = [
                'error'=>true,
                'status'=> 'fail',
                'message'=> $e->getMessage()
            ];
        }

        return redirect()->back()->with($data);
    }

    public function confirm_delete(StaffTitle $title)
    {
        return view('admin.titles.confirm_delete', compact('title'));
    }

    public function destroy(StaffTitle $title)
    {

    }
}
