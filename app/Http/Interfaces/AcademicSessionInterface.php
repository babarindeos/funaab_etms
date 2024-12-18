<?php

namespace App\Http\Interfaces;

interface AcademicSessionInterface
{
    public static function getCurrentSession();

    public static function getCurrentSemester();
}