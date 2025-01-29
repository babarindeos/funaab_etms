<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamDay;
use App\Models\Course;
use App\Models\Venue;
use App\Models\ExamTimePeriod;
use App\Models\ExamScheduler;
use Illuminate\Support\Facades\Auth;
use App\Models\ExamType;

class Admin_ExamSchedulerController extends Controller
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
        return view('admin.exam_scheduler.select_exam_day', compact('exams'))->with(['isPostBack'=>$isPostBack, 
                                                                                     'exam_selected'=>$exam_selected,
                                                                                     'exam_days_data'=>$exam_days_data]);
    }

    public function load_scheduler(Request $request)
    {
        $request->validate([
            'exam_day' => 'required'
        ]);


        return redirect()->route('admin.exams.exam_scheduler.scheduler', ['exam_day'=>$request->exam_day]);
    }

    public function scheduler(ExamDay $exam_day)
    {
        $courses = Course::orderBy('code', 'asc')->get();
        $exam_types = ExamType::orderBy('name', 'asc')->get();
        $venues = Venue::orderBy('name', 'asc')->get();
        $exam_time_periods = ExamTimePeriod::orderBy('name', 'asc')->get();


        $scheduled_day_exams = ExamScheduler::where('exam_day_id', $exam_day->id)
                                            ->orderBy('created_at', 'desc')
                                            ->get();


        $scheduled_exams = ExamScheduler::where('exam_id', $exam_day->exam->id)
                                         ->orderBy('created_at', 'desc')
                                         ->get();

       

        return view('admin.exam_scheduler.scheduler', compact('exam_day'))
                    ->with(['courses'=>$courses,
                            'exam_types'=>$exam_types, 
                            'venues'=>$venues, 
                            'exam_time_periods'=>$exam_time_periods,
                            'scheduled_day_exams'=>$scheduled_day_exams,
                            'scheduled_exams'=>$scheduled_exams
                        ]);
    }

    public function post_scheduler(Request $request, ExamDay $exam_day)
    {
        

        $formFields = $request->validate([
            'course_id'=> 'required',
            'course' => 'required',
            'exam_type' => 'required',
            'venue' => 'required',
            'time_period' => 'required'
        ]);

        
        // check if an exam has been scheduled for that venue and time
        // $venue_time_scheduled = ExamScheduler::where('exam_id', $exam_day->exam->id)
        //                                      ->where('exam_day_id', $exam_day->id)
        //                                      ->where('venue_id', $request->venue)
        //                                      ->where('time_period_id', $request->time_period)
        //                                      ->first();
        // if ($venue_time_scheduled)
        // {
        //     $data = [
        //         'error' => true,
        //         'status' => 'fail',
        //         'message' => 'The Venue has been alloted for '.$venue_time_scheduled->course->code.' exam at the same selected time '
        //     ];

        //     return redirect()->back()->with($data)->withInput();
        // }




        $formFields['academic_session_id'] = $exam_day->exam->semester->academic_session->id;
        $formFields['semester_id'] = $exam_day->exam->semester->id;
        $formFields['exam_id'] = $exam_day->exam->id;
        $formFields['exam_day_id'] = $exam_day->id;
        $formFields['course_id'] = $request->course_id;
        $formFields['exam_type_id'] = $request->exam_type;
        $formFields['venue_id'] = $request->venue;
        $formFields['time_period_id'] = $request->time_period;
        $formFields['user_id'] = Auth::user()->id;

        try
        {
            $create = ExamScheduler::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Course has been successfully scheduled'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred scheduling the Course'
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

    public function edit_schedule(ExamScheduler $schedule)
    {
        $exam_days = ExamDay::where('exam_id', $schedule->exam_id)->orderBy('created_at', 'asc')->get();
        $courses = Course::orderBy('code', 'asc')->get();
        $exam_types = ExamType::orderBy('name', 'asc')->get();
        $venues = Venue::orderBy('name', 'asc')->get();
        $exam_time_periods = ExamTimePeriod::orderBy('name', 'asc')->get();
        return view('admin.exam_scheduler.edit', compact('schedule', 'exam_days', 'courses', 'exam_types', 'venues', 'exam_time_periods'));
    }

    public function update_schedule(Request $request, ExamScheduler $schedule)
    {
        $formFields = $request->validate([
            'exam_day' => 'required',
            'course' => 'required',
            'exam_type' => 'required',
            'venue' => 'required',
            'time_period' => 'required'
        ]);

        $formFields['exam_day_id'] = $request->exam_day;
        $formFields['course_id'] = $request->course;
        $formFields['exam_type_id'] = $request->exam_type;
        $formFields['venue_id'] = $request->venue;
        $formFields['time_period_id'] = $request->time_period;

        try
        {
            $update = $schedule->update($formFields);

            if ($update)
            {
                $data = [
                    'error'=> true,
                    'status' => 'success',
                    'message' => 'The Schedule has been successfully updated'
                ];
            }
            else
            {
                $data = [
                    'error'=> true,
                    'status' => 'fail',
                    'message' => 'An error has occurred updating the schedule'
                ];

            }
        }
        catch(\Exception $e)
        {
            $data = [
                'error'=> true,
                'status' => 'fail',
                'message' => $e->getMessage()
            ];
        }

        return redirect()->back()->with($data);
    }

    public function destroy(ExamScheduler $schedule)
    {
        $schedule->delete();

        return redirect()->back();
    }
}
