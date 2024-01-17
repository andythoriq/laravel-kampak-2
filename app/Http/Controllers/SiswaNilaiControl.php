<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Student;

// use Illuminate\Http\Request;

class SiswaNilaiControl extends Controller
{
    public function __invoke()
    {

        return view('nilai.index', [
            'points' => Point::get_nilai_by_student(),
            'format' => '',
        ]);
    }
}
