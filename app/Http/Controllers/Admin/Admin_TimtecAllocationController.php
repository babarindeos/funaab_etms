<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamDay;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;
use App\Models\AssignRole;
use App\Models\VenueCategoryGroup;
use App\Models\ExamTimePeriod;
use App\Models\TimtecAllocation;


class Admin_TimtecAllocationController extends Controller
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
        return view('admin.timtec_allocations.select_exam_day', compact('exams'))->with(['isPostBack'=>$isPostBack, 
                                                                                     'exam_selected'=>$exam_selected,
                                                                                     'exam_days_data'=>$exam_days_data]);
    }

    public function load_allocator(Request $request)
    {
        $request->validate([
            'exam_day' => 'required'
        ]);


        return redirect()->route('admin.exams.timtec_allocation.allocator', ['exam_day'=>$request->exam_day]);
    }

    public function allocator(ExamDay $exam_day)
    {
        $timtec_members = AssignRole::where('staff_role_id', '3')->get();
        $venue_category_groups = VenueCategoryGroup::orderBy('name', 'asc')->get();
        $exam_time_periods = ExamTimePeriod::orderBy('name', 'asc')->get();


        $timtec_day_exams = TimtecAllocation::where('exam_day_id', $exam_day->id)
                                            ->orderBy('created_at', 'desc')
                                            ->get();

        $timtec_exams_count = TimtecAllocation::where('exam_id', $exam_day->exam->id)
                                            ->count();

       
        
        return view('admin.timtec_allocations.allocator', compact('exam_day'))
                    ->with(['timtec_members'=>$timtec_members, 
                            'venue_category_groups'=>$venue_category_groups, 
                            'exam_time_periods'=>$exam_time_periods,
                            'timtec_day_exams'=>$timtec_day_exams,
                            'timtec_exams_count'=>$timtec_exams_count
                        ]);

    }


    public function post_allocator(Request $request, ExamDay $exam_day)
    {
        $formFields = $request->validate([
            'timtec_member' => 'required',
            'venue' => 'required',
            'time_period' => 'required'
        ]);

        $formFields['academic_session_id'] = $exam_day->exam->semester->academic_session->id;
        $formFields['semester_id'] = $exam_day->exam->semester->id;
        $formFields['exam_id'] = $exam_day->exam->id;
        $formFields['exam_day_id'] = $exam_day->id;
        $formFields['timtec_member_id'] = $request->timtec_member;
        $formFields['venue_category_group_id'] = $request->venue;
        $formFields['time_period_id'] = $request->time_period;
        $formFields['user_id'] = Auth::user()->id;

        $is_timtec_member_alloted = TimtecAllocation::where('timtec_member_id', $request->timtec_member)
                                                        ->where('exam_id', $exam_day->exam->id)
                                                        ->where('exam_day_id', $exam_day->id)
                                                        ->where('time_period_id', $request->time_period)
                                                        ->first();
        if ($is_timtec_member_alloted)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => 'The Timtec member has already been alloted at the same day and time'
            ];

            return redirect()->back()->with($data);
        }

        try
        {
            $create = TimtecAllocation::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Timtec member has been successfully allocated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred allocating the Timtec member'
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


    public function destroy(TimtecAllocation $allocation)
    {
        $allocation->delete();

        return redirect()->back();
    }



}
