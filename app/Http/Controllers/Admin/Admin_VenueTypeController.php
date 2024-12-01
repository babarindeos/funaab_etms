<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VenueType;

class Admin_VenueTypeController extends Controller
{
    //
    public function index()
    {
        $venue_types = VenueType::orderBy('id', 'desc')->paginate(20);
        return view('admin.venue_types.index', compact('venue_types'));
    }

    public function create()
    {
        return view('admin.venue_types.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|string|unique:venue_types,name'
        ]);

        try
        {
            $create = VenueType::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Venue Type has been successfully created'
                ];
            }
            else
            {                
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Venue Type'
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

    public function edit(VenueType $venue_type)
    {
        return view('admin.venue_types.edit', compact('venue_type'));
    }

    public function update(Request $request, VenueType $venue_type)
    {
        $formFields = $request->validate([
            'name' => 'required|string'
        ]);

        try
        {
            $update = $venue_type->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Venue Type has been successfully updated'
                ];
            }
            else
            {                
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Venue Type'
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

    public function confirm_delete(VenueType $venue_type)
    {
        return view('admin.venue_types.confirm_delete', compact('venue_type'));
    }

    public function delete(VenueType $venue_type)
    {
        
    }
}
