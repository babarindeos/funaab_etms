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

        

        $exam_schedules = ExamScheduler::where('exam_id', $exam_day->exam_id)
                                       ->where('exam_day_id', $exam_day->id)
                                       ->orderBy('time_period_id', 'asc')
                                       ->get();
        
       

        $invigilators = AssignRole::where('staff_role_id', '1')->get();
        $venues = Venue::orderBy('name', 'asc')->get();
        $exam_time_periods = ExamTimePeriod::orderBy('name', 'asc')->get();


        $invigilation_day_exams = InvigilatorAllocation::where('exam_day_id', $exam_day->id)
                                            ->orderBy('created_at', 'desc')
                                            ->get();

        $invigilation_exams_count = InvigilatorAllocation::where('exam_id', $exam_day->exam->id)
                                            ->count();

       
        
        return view('admin.invigilator_allocations.allocator', compact('exam_day','query_schedule', 'query_level'))
                    ->with(['invigilators'=>$invigilators, 
                            'exam_schedules'=>$exam_schedules,
                            'venues'=>$venues, 
                            'exam_time_periods'=>$exam_time_periods,
                            'invigilation_day_exams'=>$invigilation_day_exams,
                            'invigilation_exams_count'=>$invigilation_exams_count
                        ]);

    }


    public function post_allocator(Request $request, ExamDay $exam_day)
    {

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
        $formFields['invigilator_id'] = $request->invigilator;
       
        $formFields['time_period_id'] = $scheduled_exam->time_period_id;
        $formFields['user_id'] = Auth::user()->id;

        // check if the invigilator has been alloted to the same exam schedule
        $is_invigilator_alloted = InvigilatorAllocation::where('invigilator_id', $request->invigilator)
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


}
