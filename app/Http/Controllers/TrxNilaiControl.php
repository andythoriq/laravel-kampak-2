<?php

namespace App\Http\Controllers;

use App\Models\Point;

// use Illuminate\Http\Request;

class TrxNilaiControl extends Controller
{
    public function index()
    {
        $classes = Point::get_current_classes();
        return view('nilai.kelas', compact('classes'));
    }

    public function show_kelas($format)
    {
        $class_id = Point::get_class_by_format($format);

        $points = Point::get_nilai_by_class($class_id);

        return view('nilai.index', compact('points', 'format'));
    }

    public function edit($format, Point $point)
    {
        $class_id = Point::get_class_by_format($format);

        return view('nilai.edit', [
            'point' => $point,
            'teachings' => Point::get_teachings_by_class($class_id),
            'students' => Point::get_students_by_class($class_id),
            'format' => $format,
        ]);
    }

    public function update($format, Point $point)
    {
        if (Point::change($point)) {
            return redirect(route('points.class', ['format' => $format]));
        }

        return back();
    }

    public function create($format)
    {
        $class_id = Point::get_class_by_format($format);

        return view('nilai.create', [
            'teachings' => Point::get_teachings_by_class($class_id),
            'students' => Point::get_students_by_class($class_id),
            'format' => $format,
        ]);
    }

    public function store($format)
    {
        if (Point::insert_new()) {
            return redirect(route('points.class', ['format' => $format]));
        }

        return back();
    }

    public function delete($format, Point $point)
    {
        if (Point::remove($point)) {
            return redirect(route('points.class', ['format' => $format]));
        }

        return back();
    }
}
