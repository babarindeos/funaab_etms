<?php

namespace App\Http\Interfaces;

use App\Models\User;
use App\Models\Venue;
use App\Models\Department;
use App\Models\Course;

interface AllocationInterface
{
    public static function isHod(User $user);
    public static function isCourseFacilitator(User $user);
    public static function getCourseFacilitator(Course $course);
    public static function isUserAvailable(User $user);
    public static function isAlternateCourseFacilitator(User $user);
    public static function getRandomCourseFacilitatorInDepartment(Department $department);
    public static function getRandomCourseFacilitatorOutsideDepartment(Department $department);
    public static function getInvigilator($exam_allocation, $schedule_allocation, $venue_invigilator_size);
    public static function isInvigilatorSlotExceeded($exam_allocation, $invigilator);
    public static function invigilatorMax(Venue $venue);
}