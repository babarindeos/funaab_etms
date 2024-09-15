<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CellType;

class Admin_CellTypeController extends Controller
{
    //
    public function index()
    {
        $cell_types = CellType::orderBy('id', 'desc')->paginate(10);

        return view('admin.cell_types.index', compact('cell_types'));
    }

    public function create()
    {
        return view('admin.cell_types.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => "required|string|unique:cell_types,name"
        ]);

        try
        {
            $celltype = new CellType();
            $celltype->name = $formFields['name'];
            $create = $celltype->save();

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Cell has been successfully created'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Cell'
                ];
            }
        }
        catch(\Exception $e)
        {   
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred - '.$e->getMessage()
                ];
        }
        
        return redirect()->back()->with($data);
    
    }

    public function edit(CellType $cell_type)
    {
        return view('admin.cell_types.edit', compact('cell_type'));
    }

    

    public function confirm_delete(CellType $cell_type)
    {
        return view('admin.cell_types.confirm_delete', compact('cell_type'));
    }

    public function destroy(CellType $cell_type)
    {
        
    }
}
