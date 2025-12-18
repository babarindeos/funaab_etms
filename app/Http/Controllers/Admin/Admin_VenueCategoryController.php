<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VenueCategory;

class Admin_VenueCategoryController extends Controller
{
    //
    public function index()
    {
        $venue_categories = VenueCategory::orderBy('id', 'desc')->paginate(100);
        return view('admin.venue_categories.index', compact('venue_categories'));
    }

    public function create()
    {
        return view('admin.venue_categories.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|string|unique:venue_categories,name'
        ]);

        try
        {
            $create = VenueCategory::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Venue Category has been successfully created'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Category Venue'
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

    public function edit(VenueCategory $venue_category)
    {
        return view('admin.venue_categories.edit', compact('venue_category'));
    }


    public function update(Request $request, VenueCategory $venue_category)
    {
        $formFields = $request->validate([
            'name' => 'required|string'
        ]);

        try
        {
            $update = $venue_category->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Venue Category has been successfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Venue Category'
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


    public function show(VenueCategory $category)
    {
        
        return view('admin.venue_categories.show')->with('venue_category', $category);
    }

    public function confirm_delete(VenueCategory $venue_category)
    {
        return view('admin.venue_categories.confirm_delete', compact('venue_category'));
    }

    public function delete(VenueCategory $venue_category)
    {

    }

}
