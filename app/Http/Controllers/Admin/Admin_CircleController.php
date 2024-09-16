<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cell;

class Admin_CircleController extends Controller
{
    //
    public function show(Cell $cell)
    {
        
        $circles = Cell::where('parent', $cell->id)->get();
        return view('admin.circles.show', compact('circles', 'cell'));
    }
}
