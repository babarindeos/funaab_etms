<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cell;
use App\Models\CellType;

class Admin_CellController extends Controller
{
    //
    public function index()
    {
        $cells = Cell::orderBy('id', 'asc')->paginate(10);
        return view('admin.cells.index', compact('cells'));
    }

    public function create()
    {
        $cell_types = CellType::orderBy('name', 'asc')->get();
        $cells = Cell::orderBy('name', 'asc')->get();
        
        return view('admin.cells.create', compact('cells', 'cell_types') );
    }

    public function store(Request $request)
    {
       
        $formFields = $request->validate([
            'type' => 'required',
            'name' => 'required|string|unique:cells,name',
            'code' => 'required|string|unique:cells,code'
        ]);

        try
        {
            $formFields['parent'] = $request->input('parent');

            $formFields['cell_type_id'] = $formFields['type'];
            $create = Cell::create($formFields);

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
                'message' => 'An error occurred creating the Cell '.$e->getMessage()
            ];
        }

        return redirect()->back()->with($data);
    }

    public function edit(Cell $cell)
    {
        $cell_types = CellType::orderBy('name', 'desc')->get();
        $cell_lists = Cell::orderBy('name', 'desc')->get();

        return view('admin.cells.edit', compact('cell', 'cell_types', 'cell_lists'));
    }

    public function update(Request $request, Cell $cell)
    {
        
        $formFields = $request->validate([
            'type' => 'required',            
            'name' => 'required|string',
            'code' => 'required|string'
        ]);

        $formFields['parent'] = $request->input('parent');

        try
        {
            $update = $cell->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Cell has been successfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Cell'
                ];
            }
        }
        catch(\Exception $e)
        {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Cell - '.$e->getMessage()
                ];
        }

        return redirect()->back()->with($data);
    }


    public function confirm_delete(Cell $cell)
    {
        return view('admin.cells.confirm_delete', compact('cell'));
    }

}
