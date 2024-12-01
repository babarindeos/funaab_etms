<?php

namespace App\Http\Classes;

use App\Http\Interfaces\AcademicSessionInterface;

use App\Models\AcademicSession;

class AcademicSessionClass implements AcademicSessionInterface
{
    public static function getCurrentSession()
    {
        $current = AcademicSession::where('current', true)->first();

        return $current;
    }
}