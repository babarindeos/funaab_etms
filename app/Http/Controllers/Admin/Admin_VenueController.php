<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venue;
use App\Models\VenueType;
use App\Models\VenueCategory;


class Admin_VenueController extends Controller
{
    //

    public function index()
    {
        $venues = Venue::orderBy('id', 'desc')->paginate(20);

        return view('admin.venues.index', compact('venues'));
    }


    public function create()
    {
        $venue_types = VenueType::orderBy('name','asc')->get();
        $venue_categories = VenueCategory::orderBy('name', 'asc')->get();

        return view('admin.venues.create', compact('venue_types', 'venue_categories'));
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|string|unique:venues,name',
            'venue_type' => 'required',
            'venue_category' => 'required',
            'student_capacity' => 'required',
            'max_invigilators' => 'required'
        ]);

        $formFields['venue_type_id'] = $request->input('venue_type');
        $formFields['venue_category_id'] = $request->input('venue_category');


        try
        {
            $create = Venue::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Venue has been successfully created'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Venue'
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


    public function edit(Venue $venue)
    {
        $venue_types = VenueType::orderBy('name','asc')->get();
        $venue_categories = VenueCategory::orderBy('name', 'asc')->get();
        return view('admin.venues.edit', compact('venue', 'venue_types', 'venue_categories'));
    }

    public function update(Request $request, Venue $venue)
    {
        $formFields = $request->validate([
            'name' => 'required|string',
            'venue_type' => 'required',
            'venue_category' => 'required',
            'student_capacity' => 'required',
            'max_invigilators' => 'required'
        ]);

        $formFields['venue_type_id'] = $request->venue_type;
        $formFields['venue_category_id'] = $request->venue_category;

        try
        {
            $update = $venue->update($formFields);

            if ($update)
            {
                 $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Venue is has successfully updated'
                 ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'AN error occurred updating the Venue'
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

    public function confirm_delete(Venue $venue)
    {
        return view('admin.venues.confirm_delete', compact('venue'));
    }

    public function destroy(Venue $venue)
    {
        
    }

    public function show(Venue $venue)
    {
        return view('admin.venues.show', compact('venue'));
    }
}
