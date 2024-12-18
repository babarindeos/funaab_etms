<?php

namespace App\Http\Classes;

use App\Http\Interfaces\AcademicSessionInterface;

use App\Models\AcademicSession;
use App\Models\Semester;

class AcademicSessionClass implements AcademicSessionInterface
{
    public static function getCurrentSession()
    {
        $current = AcademicSession::where('current', true)->first();

        return $current;
    }

    public static function getCurrentSemester()
    {
        $current = Semester::where('current', true)->first();

        return $current;
    }
}