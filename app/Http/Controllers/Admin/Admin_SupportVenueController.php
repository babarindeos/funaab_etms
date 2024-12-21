<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamDay;
use App\Models\ExamScheduler;
use App\Models\Venue;
use App\Models\SupportVenue;

class Admin_SupportVenueController extends Controller
{
    //
    public function index(ExamDay $exam_day, ExamScheduler $schedule)
    {
        $venues = Venue::orderBy('name', 'asc')->get();
        $support_venues = SupportVenue::where('schedule_id', $schedule->id)->get();

        return view('admin.support_venues.index', compact('exam_day', 'schedule', 'venues', 'support_venues'));
    }

    public function store(Request $request, ExamDay $exam_day, ExamScheduler $schedule)
    {
            $formFields = $request->validate([
                'venue' => 'required'
            ]);

            $formFields['venue_id'] = $request->venue;
            $formFields['schedule_id'] = $schedule->id;

            // check if already added
            $is_added = SupportVenue::where('schedule_id')
                                    ->where('venue_id')
                                    ->exists();
            if($is_added)
            {
                    $data = [
                        'error' => true,
                        'status' => 'fail',
                        'message' => 'The Support Venue has already been added to the exam'
                    ];
            }


            try
            {
                $create = SupportVenue::create($formFields);

                if ($create)
                {
                    $data = [
                        'error' => true,
                        'status' => 'success',
                        'message' => 'The Support Venue has been successfully added to the exam'
                    ];
                }
                else
                {
                    $data = [
                        'error' => true,
                        'status' => 'fail',
                        'message' => 'An error occurred adding the support venue'
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

    public function destroy(SupportVenue $support_venue)
    {
        $support_venue->delete();

        return redirect()->back();
    }
}
