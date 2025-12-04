<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Semester;

class Manager_ExamController extends Controller
{
    //
    public function index()
    {
        $exams = Exam::orderBy('created_at', 'desc')->paginate(20);

        return view('manager.exams.index', compact('exams'));
    }

    

    

    

    

    
}
