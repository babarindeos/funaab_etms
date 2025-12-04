<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\College;
use App\Models\Department;
use App\Models\Staff;
use App\Models\Ministry;
use Illuminate\Support\Str;
use App\Models\User;
use Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\NewUserEmail;
use App\Models\StaffTitle;
use App\Models\StaffStatus;

class Manager_StaffController extends Controller
{
    //
    public function index(Request $request){
       
        $query = $request->query('q');
        
        if ($query == null)
        {
             $staffs = Staff::orderBy('surname', 'asc')
                        ->orderBy('firstname', 'asc')
                        ->orderBy('middlename', 'asc')
                        ->paginate(100);
        }
        else
        {
             $staffs = Staff::where('surname','like',"%{$query}%")
                        ->orderBy('surname', 'asc')
                        ->orderBy('firstname', 'asc')
                        ->orderBy('middlename', 'asc')
                        ->paginate(100);
        }

       
        return view('manager.staff.index', compact('staffs'));

    }
}
