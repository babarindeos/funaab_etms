<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workflow;
use App\Models\PrivateMessage;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Http\Classes\AcademicSessionClass;
use App\Models\InvigilatorAllocation;
use App\Models\ChiefAllocation;
use App\Models\TimtecAllocation;

class Staff_DashboardController extends Controller
{

    public function __construct()
    {
        // check if the user profile has been filled
       
    }

    //
    public function index()
    {
        
        $profileExists = Profile::where('user_id', Auth::user()->id)->exists();

        // if user profile does not exist, create it
        if (!$profileExists)
        {
            return redirect()->route('staff.profile.create');
        }

        // get notification
        $workflow_notifications = Workflow::where('recipient_id', Auth::user()->id)
                                            ->where('read', false)
                                            ->orderBy('id', 'desc')->paginate(5);

        $private_message_notifications = PrivateMessage::where('recipient_id', Auth::user()->id)
                                                       ->where('read', false)
                                                       ->orderBy('id', 'desc')->paginate(5);

        $recent_workflows = Workflow::latest()->take(5)->get();      
        
        $current_user =  Auth::user()->id;
        //dd($current_user);

        $recent_workflows = Workflow::where('recipient_id','=', $current_user)->latest()->take(5)->get();

        

        
        // get current academic_session
        $current_semester = AcademicSessionClass::getCurrentSemester();

        $invigilator = null;
        $chief = null;
        $timtec = null;
        
        if ($current_semester != null)
        {
                $invigilator = InvigilatorAllocation::where('semester_id', $current_semester->id)
                                            ->where('invigilator_id', Auth::user()->id)
                                            ->orderBy('exam_day_id', 'asc')
                                            ->orderBy('time_period_id', 'asc')
                                            ->get();
                
                $chief = ChiefAllocation::where('semester_id', $current_semester->id)
                                            ->where('chief_id', Auth::user()->id)
                                            ->orderBy('exam_day_id', 'asc')
                                            ->orderBy('time_period_id', 'asc')
                                            ->get();

                $timtec = TimtecAllocation::where('semester_id', $current_semester->id)
                                            ->where('timtec_member_id', Auth::user()->id)
                                            ->orderBy('exam_day_id', 'asc')
                                            ->orderBy('time_period_id', 'asc')
                                            ->get();
        }      


        
        return view('staff.dashboard', compact('workflow_notifications', 
                                               'recent_workflows', 
                                               'private_message_notifications',
                                               'current_semester',
                                               'invigilator',
                                               'chief',
                                               'timtec'));

    }
}
