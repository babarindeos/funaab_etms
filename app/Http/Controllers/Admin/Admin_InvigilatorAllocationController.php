<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamDay;
use App\Models\Staff;
use App\Models\Venue;
use App\Models\ExamTimePeriod;
use App\Models\InvigilatorAllocation;
use Illuminate\Support\Facades\Auth;
use App\Models\AssignRole;
use App\Models\ExamScheduler;
use App\Models\SupportVenue;

use Illuminate\Support\Facades\DB;


    // AssignRole model - assign_roles table

    // 1. Invigilator - INV
    // 2. Observer - OBS
    // 3. TIMTEC Member - TTC
    // 4. Chief - CHF


class Admin_InvigilatorAllocationController extends Controller
{
    //
    public function select_exam_day(Request $request)
    {
        $exam_selected = null;
        $exam_days_data = null;
        $isPostBack = false;
        
        if ($request->input('exam') != '')
        {
            $isPostBack = true;
            $exam_selected = $request->get('exam');


            $exam_days_data = ExamDay::where('exam_id', $request->get('exam'))
                                       ->orderBy('created_at','desc')
                                       ->get();

            
        }

        $exams = Exam::orderBy('created_at', 'desc')->get();
        return view('admin.invigilator_allocations.select_exam_day', compact('exams'))->with(['isPostBack'=>$isPostBack, 
                                                                                     'exam_selected'=>$exam_selected,
                                                                                     'exam_days_data'=>$exam_days_data]);
    }


    public function load_allocator(Request $request)
    {
        $request->validate([
            'exam_day' => 'required'
        ]);


        return redirect()->route('admin.exams.invigilator_allocation.allocator', ['exam_day'=>$request->exam_day]);
    }

    public function allocator(Request $request, ExamDay $exam_day)
    {
        
        $query_schedule = $request->query('schedule');
        
        $query_level = $request->query('level');

        //dd($query_level);

        $schedule_venue_invigilation = null;
        $schedule_day_invigilation = null;
        $exam_schedule = null;
        $exam_day_schedules = null;

        if ($query_schedule != null && $query_level != null)
        {
                $exam_schedule = ExamScheduler::find($query_schedule);

                $schedule_venue_invigilation = InvigilatorAllocation::where('exam_id', $exam_schedule->exam_id)
                                                             ->where('exam_day_id', $exam_schedule->exam_day_id)
                                                             ->where('venue_id', $exam_schedule->venue_id)
                                                             ->where('time_period_id', $exam_schedule->time_period_id)
                                                             ->orderBy('time_period_id', 'asc')
                                                             ->get();
        }
        else
        {

                $exam_day_schedules = ExamScheduler::where('exam_id', $exam_day->exam_id)
                                       ->where('exam_day_id', $exam_day->id)
                                       ->orderBy('time_period_id', 'asc')
                                       ->get(); 

                $schedule_day_invigilation = ExamScheduler::where('exam_id', $exam_day->exam_id)
                                                   ->where('exam_day_id', $exam_day->id)
                                                   ->orderBy('time_period_id', 'asc')
                                                   ->get(); 

        }
             

        //dd($exam_day_schedules);

        
        
        //dd($schedule_venue_invigilation);



        
        
        
       

        $invigilators = AssignRole::where('staff_role_id', '1')->get();
        $venues = Venue::orderBy('name', 'asc')->get();
        $exam_time_periods = ExamTimePeriod::orderBy('name', 'asc')->get();


        $invigilation_day_exams = InvigilatorAllocation::where('exam_day_id', $exam_day->id)
                                            ->orderBy('created_at', 'desc')
                                            ->get();

        $invigilation_exams_count = InvigilatorAllocation::where('exam_id', $exam_day->exam->id)
                                            ->count();

       // $schedule_invigilation = 
       
        
        return view('admin.invigilator_allocations.allocator', compact('exam_day','query_schedule', 'query_level'))
                    ->with(['invigilators'=>$invigilators, 
                            'exam_schedule'=>$exam_schedule,
                            'exam_day_schedules' => $exam_day_schedules,
                            'schedule_venue_invigilation' => $schedule_venue_invigilation,
                            'schedule_day_invigilation' => $schedule_day_invigilation,
                            'exam_time_periods'=>$exam_time_periods,
                            'invigilation_day_exams'=>$invigilation_day_exams,
                            'invigilation_exams_count'=>$invigilation_exams_count
                        ]);

    }


    public function post_allocator(Request $request, ExamDay $exam_day)
    {

        //dd($request);

       if ($request->query_schedule != null && $request->query_level != null)
       {
            $formFields = $request->validate([
                'invigilator' => 'required',
            ]);

            $formFields['exam_schedule_id'] = $request->query_schedule;

            if ($request->query_level != null)
            {
                    $scheduled_exam = ExamScheduler::find($request->query_schedule);

                    if ($request->query_level == 'main' && $scheduled_exam != null)
                    {
                            $formFields['exam_schedule_id'] = $scheduled_exam->id;
                            $formFields['venue_id'] =  $scheduled_exam->venue_id;
                    }
                    else if ($request->query_level == 'support' && $scheduled_exam != null)
                    {
                            $scheduled_exam = SupportVenue::where('schedule_id', $request->query_schedule)->first();
                            $formFields['exam_schedule_id'] = $scheduled_exam->schedule_id;
                            $formFields['venue_id'] =  $scheduled_exam->venue_id;

                    }
                    else
                    {
                            return redirect()->route('admin.dashboard.index');
                    }

            }           
            else
            {
                    return redirect()->route('admin.dashboard.index');
            }
       }      
       else
       {
                $formFields = $request->validate([
                    'invigilator' => 'required',
                    'scheduled_exam' => 'required',
                ]);

                $scheduled_exam = ExamScheduler::find($request->scheduled_exam);

                $formFields['exam_schedule_id'] = $scheduled_exam->id;
                $formFields['venue_id'] = $scheduled_exam->venue_id;
       }



        $scheduled_exam = ExamScheduler::find($formFields['exam_schedule_id']);
       

        $formFields['academic_session_id'] = $exam_day->exam->semester->academic_session->id;
        $formFields['semester_id'] = $exam_day->exam->semester->id;
        $formFields['exam_id'] = $exam_day->exam->id;
        $formFields['exam_day_id'] = $exam_day->id;
        $formFields['invigilator_id'] = $request->invigilator_id;
       
        $formFields['time_period_id'] = $scheduled_exam->time_period_id;
        $formFields['user_id'] = Auth::user()->id;

        // check if the invigilator has been alloted to the same exam schedule
        $is_invigilator_alloted = InvigilatorAllocation::where('invigilator_id', $request->invigilator_id)
                                                        ->where('exam_schedule_id', $formFields['exam_schedule_id'])
                                                        ->first();

        if ($is_invigilator_alloted)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => 'The invigilator has already been alloted to the venue ['. $is_invigilator_alloted->venue->name.'] at the same day and time'
            ];

            return redirect()->back()->with($data);
        }


        // check if the invigilator has been alloted to exams on the same day
        $is_invigilator_alloted = InvigilatorAllocation::where('invigilator_id', $request->invigilator)
                                                        ->where('exam_id', $exam_day->exam->id)
                                                        ->where('exam_day_id', $exam_day->id)
                                                        ->first();

        if ($is_invigilator_alloted)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => 'The invigilator has already been alloted to the venue ['. $is_invigilator_alloted->venue->name.'] on the same day'
            ];

            return redirect()->back()->with($data);
        }


        try
        {
            $create = InvigilatorAllocation::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Invigilator has been successfully allocated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred allocating the invigilator'
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

    public function destroy(InvigilatorAllocation $allocation)
    {
        $allocation->delete();

        return redirect()->back();
    }



    public function fetch_invigilator(Request $request)
    {
        $search_term = $request->query('search_term');

        $invigilator_options = '';

        /* $invigilators = DB::table('staff')
                            ->join('assign_roles', function ($join) use ($search_term) {
                                $join->on('staff.user_id', '=', 'assign_roles.user_id')
                                
                                    ->where(function ($query) use ($search_term) {
                                        $query->where('staff.fileno', 'LIKE', "%{$search_term}%")
                                            ->orWhere('staff.surname', 'LIKE', "%{$search_term}%")
                                            ->orWhere('staff.firstname', 'LIKE', "%{$search_term}%")
                                            ->orWhere('assign_roles.staff_role_id', '=', '1');
                                    });
                                })
                                ->select('staff.user_id', 'staff.fileno', 'staff.surname', 'staff.firstname')
                                ->groupBy('staff.user_id', 'staff.fileno', 'staff.surname', 'staff.firstname')
                                ->get(); */

        
       /*  $invigilators = DB::table('staff')
                        ->join('staff_titles', 'staff.title_id', '=', 'staff_titles.id')
                        ->join('assign_roles', 'staff.user_id', '=', 'assign_roles.user_id')
                        ->where(function ($query) use ($search_term) {
                            $query->where('staff.fileno', 'LIKE', "%{$search_term}%")
                                ->orWhere('staff.surname', 'LIKE', "%{$search_term}%")
                                ->orWhere('staff.firstname', 'LIKE', "%{$search_term}%")
                                ->orWhere('assign_roles.staff_role_id', '=', '1');
                        })
                            ->select(
                                'staff.user_id',
                                'staff_titles.title',
                                'staff.fileno',
                                'staff.surname',
                                'staff.firstname'
                            )
                            ->groupBy(
                                'staff.user_id',
                                'staff_titles.title',
                                'staff.fileno',
                                'staff.surname',
                                'staff.firstname'
                            )
                            ->get();
        */ 


        $invigilators = DB::table('staff')
                        ->join('staff_titles', 'staff.title_id', '=', 'staff_titles.id')
                        ->join('assign_roles', 'staff.user_id', '=', 'assign_roles.user_id')
                        ->where(function ($query) use ($search_term) {
                            $query->where('staff.fileno', 'LIKE', "%{$search_term}%")
                                  ->where('assign_roles.staff_role_id', '=', '1')
                                  ->orWhere('staff.surname', 'LIKE', "%{$search_term}%")
                                  ->orWhere('staff.firstname', 'LIKE', "%{$search_term}%");
                                
                        })
                            ->select(
                                'staff.user_id',
                                'staff_titles.title',
                                'staff.fileno',
                                'staff.surname',
                                'staff.firstname'
                            )
                            ->groupBy(
                                'staff.user_id',
                                'staff_titles.title',
                                'staff.fileno',
                                'staff.surname',
                                'staff.firstname'
                            )
                            ->get();



        foreach($invigilators as $invigilator)
        {
            $staff = " (".$invigilator->fileno.") - ".$invigilator->title." ".$invigilator->surname." ".$invigilator->firstname;
            $invigilator_options .= "<div class='py-3 border border-gray-500 cursor-pointer px-2' id='".$invigilator->user_id."'> ".$staff."</div>";
        }

        return $invigilator_options;
    }


}
