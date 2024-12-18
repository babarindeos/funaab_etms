<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamDay;
use App\Models\Exam;
use App\Models\ExamScheduler;
use App\Models\InvigilatorAllocation;
use App\Models\ChiefAllocation;
use App\Models\TimtecAllocation;

class Admin_ExamDayController extends Controller
{
    //
    public function index(Exam $exam)
    {
        $exam_days = ExamDay::where('exam_id', $exam->id)
                            ->orderby('created_at','desc')->paginate(100);
        
        $scheduled_exams = ExamScheduler::where('exam_id', $exam->id)->get();

       

        return view('admin.exam_days.index', compact('exam_days', 'exam', 'scheduled_exams'));
    }

    public function create(Exam $exam)
    {
        return view('admin.exam_days.create', compact('exam'));
    }

    public function store(Request $request, Exam $exam)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'date' => 'required'
        ]);

        $formFields['exam_id'] = $exam->id;

        try
        {
            $create = ExamDay::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Exam Day has been successfully created'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Exam Day'
                ];
            }
        }
        catch(\Exception $e)
        {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => $e->getMessage()
                ];
        }

        return redirect()->back()->with($data);
    }


    public function edit(Exam $exam, ExamDay $day)
    {
        return view('admin.exam_days.edit', compact('exam', 'day'));
    }

    public function update(Request $request, Exam $exam, ExamDay $day)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'date' => 'required'
        ]);

        $formFields['exam_id'] = $exam->id;

        try
        {
            $update = $day->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Exam Day has been successfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'An error occurred updating the Exam Day'
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

    public function confirm_delete(Exam $exam, ExamDay $day)
    {
            return view('admin.exam_days.confirm_delete', compact('exam', 'day'));
    }

    public function destroy(Exam $exam, ExamDay $day)
    {
        
    }

    public function select_exam_days(Request $request)
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
        return view('admin.exam_days_schedules.select_exam_day', compact('exams'))->with(['isPostBack'=>$isPostBack, 
                                                                                     'exam_selected'=>$exam_selected,
                                                                                     'exam_days_data'=>$exam_days_data]);
    }

    public function load_exam_day_schedule(Request $request)
    {
        $request->validate([
            'exam_day' => 'required'
        ]);


        return redirect()->route('admin.exams.exam_days.exam_day_schedule', ['exam_day'=>$request->exam_day]);
        
    }

    public function exam_day_schedule(ExamDay $exam_day)
    {
        $exam_schedules = ExamScheduler::where('exam_day_id', $exam_day->id)
                                        ->orderBy('time_period_id', 'asc')
                                        ->get();    
        
        $invigilators = InvigilatorAllocation::where('exam_day_id', $exam_day->id)
                                               ->get();
        
        $chiefs = ChiefAllocation::where('exam_day_id', $exam_day->id)->get();

        $timtec_members = TimtecAllocation::where('exam_day_id', $exam_day->id)->get();   

        
        //dd($invigilators);
        
        return view('admin.exam_days_schedules.exam_schedule', compact('exam_schedules','exam_day', 'invigilators', 'chiefs', 'timtec_members'));
    }   

}
