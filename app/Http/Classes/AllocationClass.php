<?php

namespace App\Http\Classes;

use App\Http\Interfaces\AllocationInterface;
use App\Models\User;
use App\Models\Venue;
use App\Models\Department;
use App\Models\Course;
use App\Models\Staff;

class AllocationClass implements AllocationInterface
{
    public static function isHod(User $user)
    {

    }

    public static function isCourseFacilitator(User $user)
    {

    }

    public static function getCourseFacilitator(Course $course)
    {
            // Get the course facilitator 
            $course_facilitators = $course->coordinators;


            // check if there is a course facilitator for the course
            // if no course facilitator
            // get an available staff from the department
            if($course_facilitators->count())
            {
                 //loop through the course coordinators
                 foreach($course_facilitators as $course_facilitator)
                 {
                    // check for availability of the course coordinator
                    $is_facilitator_available = $course_facilitator->available;

                    if ($is_facilitator_available && $course_facilitator->hod == null)
                    {
                        // check if he/she is the hod of the department
                        // if he/she is, then cannot he returened for the invigilator
                        
                        return $course_facilitator;
                    }                    
                 }
                 

                  

                 // no course coordinator has been obtained
                 // source for a staff in the same department
                 $course_facilitator_department = $course_facilitator->coordinator->staff->department;

                 $random_course_facilitator_in_department = self::getRandomCourseFacilitatorInDepartment($course_facilitator_department);
                 
                 // if a staff is obtained from the department, return same as the random_course_coordinator
                 // if null is return i.e no available staff in that department
                 if ($random_course_facilitator_in_department != null)
                 {
                     return $random_course_facilitator_in_department;
                 }

                 // since no random_course_coordinator is found in the department
                 // search in other departments except the department hosting the course
                 $random_course_facilitator_outside_department = self::getRandomCourseFacilitatorOutsideDepartment($course_facilitator_department);
                 
                 return $random_course_facilitator_outside_department;
            }
            else
            {
                // get the department of the course
                $course_department = $course->department;

                // there is no course coordinator, get a random course coordinator from the department
                $random_course_coordinator_in_department = self::getRandomCourseFacilitatorInDepartment($course_department);


                if ($random_course_coordinator_in_department != null)
                {
                    return $random_course_coordinator_in_department;
                }


                // since no random_course_coordinator is found in the department
                 // search in other departments except the department hosting the course
                 $random_course_facilitator_outside_department = self::getRandomCourseFacilitatorOutsideDepartment($course_department);
                 
                 return $random_course_facilitator_outside_department;


            }
    }

    public static function isUserAvailable(User $user)
    {

    }

    public static function isAlternateCourseFacilitator(User $user)
    {

    }

    public static function getRandomCourseFacilitatorInDepartment(Department $department)
    {
        // Get all staff in this department
        // the randomly pick one from here
        $staff = Staff::where('department_id', $department->id)->get();

        if ($staff->count())
        {

            $available_staff = array();

            // take out the hod from the staff list
            // get the list of other staff available
            foreach($staff as $person)
            {
                if ($person->user->hod != null)
                {
                    continue;
                }
                
                if ($person->user->available != null)
                {
                    array_push($available_staff, $person);
                }
            }


            // Give a random staff from the available staff list if available_staff is not empty

          if (count($available_staff))
          {
                $array_size = count($available_staff);
                $random_number = mt_rand(0, $array_size-1);
                $random_course_facilitator = $available_staff[$random_number];

                return $random_course_facilitator;
          }

          return null;
           
        }
        
    }


    public static function getRandomCourseFacilitatorOutsideDepartment(Department $department)
    {
        // get all staff in all department except the one sent in here
        $all_staff_outside_department = Staff::where('department_id', '!=', $department->id)->get();
        
        $staff_outside_department_not_hod_and_available = array();

        foreach($all_staff_outside_department as $person)
        {
            if ($person->user->hod != null)
            {
                continue;
            }

            // check if the user is available, the add to the list of staff not hod, and available
            if ($person->user->available != null)
            {
                array_push($staff_outside_department_not_hod_and_available, $person);
            }
            
        }



        // check if there is available staff in the staff list returned
        if (count($staff_outside_department_not_hod_and_available))
        {
            // get a random course coordinate outside the department within this staff list
            $array_size = count($staff_outside_department_not_hod_and_available);
            $random_number = mt_rand(0, $array_size-1);
            $random_course_facilitator_outside_department = $staff_outside_department_not_hod_and_available[$random_number];

            return $random_course_facilitator_outside_department;
        }

        return null;
        

    }

    public static function getInvigilator($exam_allocation, $schedule_allocation, $venue_invigilator_size)
    {
        // get all staff that are available and not in the schedule_allocation already
       
        $all_staff_not_in_schedule_allocation_not_hod_and_available = array();

        $all_staff = Staff::get();

        // get items into the array of staff not in the schedule array
        // and that are available
        foreach($all_staff as $staff)
        {
            
            foreach($schedule_allocation as $allocation)
            {
                if ($staff->id == $allocation->id)
                {
                    continue;
                }

                if ($staff->user->hod != null)
                {
                    continue;
                }
              
                
                if ($staff->user->available != null )
                {
                    //check that the staff user has not exceeded his/her slot number
                    $is_slot_exceeded = self::isInvigilatorSlotExceeded($exam_allocation, $staff);

                    dd($is_slot_exceeded);

                    array_push($all_staff_not_in_schedule_allocation_not_hod_and_available, $staff);
                }

            }
        }

      
        // shuffle the items in the array
        $shuffle = shuffle($all_staff_not_in_schedule_allocation_not_hod_and_available);

        // get the size of the remaining invigilator left for this schedule
        $remaining_invigilators = $venue_invigilator_size - count($schedule_allocation);
        
        // get the count of available staff for allocation to match the venue allocation
        $all_staff_not_in_schedule_allocation_not_hod_and_available_count = count($all_staff_not_in_schedule_allocation_not_hod_and_available);
       
        for($i = 0; $i < $remaining_invigilators; $i++)
        {
             if ($all_staff_not_in_schedule_allocation_not_hod_and_available_count == 0)
             {
                break;
             }

             array_push($schedule_allocation, $all_staff_not_in_schedule_allocation_not_hod_and_available[$i]);   

        }


        dd($schedule_allocation);

        

        
    }

    public static function isInvigilatorSlotExceeded($exam_allocation, $invigilator)
    {
        $is_max_slot_reached = false;

        $no_of_invigilator_slot = 0;

        foreach($exam_allocation as $allocation)
        {
            if ($allocation->id == $invigilator->id)
            {
                ++$no_of_invigilator_slot;
            }

        }

        if($invigilator->staff_title->title == "Prof." ||  $invigilator->staff_title->title == "Prof. (Mrs.)")
        {
            if ($no_of_invigilator_slot > 5)
            {
                $is_max_slot_reached = true;
            }
        }
        else
        {
            if ($no_of_invigilator_slot > 12)
            {
                $is_max_slot_reached = true;
            }
        }
        
        return $is_max_slot_reached;
    }

    public static function invigilatorMax(Venue $venue)
    {

    }
}