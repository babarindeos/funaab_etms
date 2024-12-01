<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VenueCategoryGroup;
use App\Models\VenueCategory;
use App\Models\VenueCategoryGroupItem;

class Admin_VenueCategoryGroupController extends Controller
{
    //
    public function index()
    {
        $venue_category_groups = VenueCategoryGroup::orderBy('id','desc')->paginate(10);
        return view('admin.venue_category_groups.index', compact('venue_category_groups'));
    }

    public function create()
    {
        return view('admin.venue_category_groups.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'string|required|unique:venue_category_groups,name'
        ]);

        try
        {
            $create = VenueCategoryGroup::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Venue Category Group has been successfully created'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Venue Category Group'
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


    public function edit(VenueCategoryGroup $group)
    {
        $venue_category_group = $group;
        return view('admin.venue_category_groups.edit', compact('venue_category_group'));
    }

    public function show(VenueCategoryGroup $group)
    {
        $venue_category_group = $group;
        $added_categories = VenueCategoryGroupItem::where('venue_category_group_id', $group->id)->get();

        return view('admin.venue_category_groups.show', compact('venue_category_group','added_categories'));
    }

    public function update(Request $request, VenueCategoryGroup $group)
    {
        $formFields = $request->validate([
            'name' => 'string|required'
        ]);

        try
        {
            $update = $group->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => ' The Category Group has been successfully updated'
                ];

            }
            else
            {   
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Category Group'
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


    public function confirm_delete(VenueCategoryGroup $group)
    {
        $venue_category_group = $group;

        return view('admin.venue_category_groups.confirm_delete', compact('venue_category_group'));
    }


    public function delete(VenueCategoryGroup $group)
    {
        dd($group);
    }

    public function add_category(VenueCategoryGroup $group)
    {
        $venue_category_group = $group;
        $venue_categories = VenueCategory::orderBy('name','asc')->get();

        $added_categories = VenueCategoryGroupItem::where('venue_category_group_id', $group->id)->get();

        return view('admin.venue_category_groups.add_category', compact('venue_category_group', 'venue_categories', 'added_categories'));
    }


    public function store_category(Request $request, VenueCategoryGroup $group)
    {
        $formFields = $request->validate([
            'venue_category' => 'required'
        ]);

        $venue_category_group_id = $group->id;
        $venue_category_id = $request->input('venue_category');

        $formFields['venue_category_group_id'] = $venue_category_group_id;
        $formFields['venue_category_id'] = $venue_category_id;

        // check if the item already exist
        $already_exist = VenueCategoryGroupItem::where('venue_category_group_id', $venue_category_group_id)
                                                ->where('venue_category_id', $venue_category_id)
                                                ->exists();
        if ($already_exist)
        {
            $data = [
                'error'=> true,
                'status' => 'fail',
                'message' => ' The Category already exist in the Group'
            ];

            return redirect()->back()->with($data);
        }

        try
        {
            $add_category = VenueCategoryGroupItem::create($formFields);

            if ($add_category)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Category has been successfully added'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred adding the Category to the Group'
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


    public function remove_category(VenueCategoryGroupItem $group_item)
    {
        $group_item->delete();

        return redirect()->back();
    }
}
