<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Http\Classes\AllocationClass;
use App\Models\Staff;

class Admin_AutomaticInvigilatorAllocationController extends Controller
{
    //
    public function index(Exam $exam)
    {
            $schedules = $exam->exam_schedule;

            $exam_allocation = array();    // array of exam allocations
            $schedule_allocation = array();  // array of a single schedule
            $schedule_day_allocation = array();

            $test_array = array();
           

            $test_schedule1 = Staff::find(2);
            $test_schedule2 = Staff::find(2);

            array_push($test_array, $test_schedule1, $test_schedule2);

            $count_slot = 0;
            
            array_push($exam_allocation, $test_array);
            foreach($exam_allocation as $exam)
            {
                
                foreach($exam as $schedule)
                {
                    $schedule->id;
                }
            }

            dd($test_array);


            // loop through the schedule
            foreach($schedules as $schedule)
            {

                    // clear the schedule allocation array
                    $schedule_allocation = [];

                    // Get the venue of the schedule
                    $venue = $schedule->venue;
                    
                    // get the number of invigilators for the venue
                    $venue_invigilator_size = $venue->max_invigilators;

                    //loop through and get the invigilator according to the venue invigilator size
                    for ($i = 1; $i <= $venue_invigilator_size; $i++)
                    {
                        // For the first iteration, get the lead invigilation i.e the Course Facilitator
                        // If the Course Facilitator is not available, pick the alternate facilitator
                        // if the alternate is not available pick any one from the department 
                        // if none is available from the department, pick any user from anywhere
                        $schedule_course = $schedule->course;
                       

                        if ($i == 1)
                        {
                                
                                $course_facilitator = AllocationClass::getCourseFacilitator($schedule_course);

                                if ($course_facilitator != null)
                                {
                                    array_push($schedule_allocation, $course_facilitator);
                                }
                        }


                        $schedule_invigilators = AllocationClass::getInvigilator($exam_allocation, $schedule_allocation, $venue_invigilator_size);


                    }
            }

            

       
    }
}
