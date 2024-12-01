<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RemunerationRate;

class Admin_RemunerationRateController extends Controller
{
    //
    public function index()
    {
        $remuneration_rates = RemunerationRate::orderBy('id', 'desc')->paginate(10);
        return view('admin.remuneration_rates.index', compact('remuneration_rates'));
    }


    public function create()
    {
        
        return view('admin.remuneration_rates.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|string|unique:remuneration_rates,name',
            'amount' => 'required|numeric',
            'point' => 'required|numeric'
        ]);

        try
        {
            $create = RemunerationRate::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Remuneration rate has been successfully created'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Remuneration rate'
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

    public function edit(RemunerationRate $rate)
    {
        return view('admin.remuneration_rates.edit')->with(['remuneration_rate'=>$rate]);
    }

    public function update(Request $request, RemunerationRate $rate)
    {
        $formFields = $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'point' => 'required|numeric'
        ]);

        try
        {
            $update = $rate->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Remuneration rate has been successfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Remuneration rate'
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

    public function confirm_delete(RemunerationRate $rate)
    {
        return view('admin.remuneration_rates.confirm_delete')->with(['remuneration_rate'=>$rate]);
    }

    public function destroy(RemunerationRate $rate)
    {
        $rate->delete();

        return redirect()->route('admin.remuneration_rates.index');
    }
}
