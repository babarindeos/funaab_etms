<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamDay;
use App\Models\ChiefAllocation;
use App\Models\Venue;
use App\Models\Staff;
use App\Models\ExamTimePeriod;
use App\Models\AssignRole;
use App\Models\VenueCategoryGroup;
use Illuminate\Support\Facades\Auth;


    // AssignRole model - assign_roles table

    // 1. Invigilator - INV
    // 2. Observer - OBS
    // 3. TIMTEC Member - TTC
    // 4. Chief - CHF


class Admin_ChiefAllocationController extends Controller
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
        return view('admin.chief_allocations.select_exam_day', compact('exams'))->with(['isPostBack'=>$isPostBack, 
                                                                                     'exam_selected'=>$exam_selected,
                                                                                     'exam_days_data'=>$exam_days_data]);
    }

    public function load_allocator(Request $request)
    {
        $request->validate([
            'exam_day' => 'required'
        ]);


        return redirect()->route('admin.exams.chief_allocation.allocator', ['exam_day'=>$request->exam_day]);
    }

    public function allocator(ExamDay $exam_day)
    {
        $chiefs = AssignRole::where('staff_role_id', '4')->get();
        $venue_category_groups = VenueCategoryGroup::orderBy('name', 'asc')->get();
        $exam_time_periods = ExamTimePeriod::orderBy('name', 'asc')->get();


        $chief_day_exams = ChiefAllocation::where('exam_day_id', $exam_day->id)
                                            ->orderBy('created_at', 'desc')
                                            ->get();

        $chief_exams_count = ChiefAllocation::where('exam_id', $exam_day->exam->id)
                                            ->count();

       
        
        return view('admin.chief_allocations.allocator', compact('exam_day'))
                    ->with(['chiefs'=>$chiefs, 
                            'venue_category_groups'=>$venue_category_groups, 
                            'exam_time_periods'=>$exam_time_periods,
                            'chief_day_exams'=>$chief_day_exams,
                            'chief_exams_count'=>$chief_exams_count
                        ]);

    }


    public function post_allocator(Request $request, ExamDay $exam_day)
    {
        $formFields = $request->validate([
            'chief' => 'required',
            'venue' => 'required',
            'time_period' => 'required'
        ]);

        $formFields['academic_session_id'] = $exam_day->exam->semester->academic_session->id;
        $formFields['semester_id'] = $exam_day->exam->semester->id;
        $formFields['exam_id'] = $exam_day->exam->id;
        $formFields['exam_day_id'] = $exam_day->id;
        $formFields['chief_id'] = $request->chief;
        $formFields['venue_category_group_id'] = $request->venue;
        $formFields['time_period_id'] = $request->time_period;
        $formFields['user_id'] = Auth::user()->id;

        $is_chief_alloted = ChiefAllocation::where('chief_id', $request->chief)
                                                        ->where('exam_id', $exam_day->exam->id)
                                                        ->where('exam_day_id', $exam_day->id)
                                                        ->where('time_period_id', $request->time_period)
                                                        ->first();
        if ($is_chief_alloted)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => 'The Chief has already been alloted at the same day and time'
            ];

            return redirect()->back()->with($data);
        }

        try
        {
            $create = ChiefAllocation::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Chief has been successfully allocated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred allocating the Chief'
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


    public function destroy(ChiefAllocation $allocation)
    {
        $allocation->delete();

        return redirect()->back();
    }

}
