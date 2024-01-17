<?php

namespace App\Http\Controllers;

use App\Models\Teacher;

// use Illuminate\Http\Request;

class MasterTeacherControl extends Controller
{
    public function index()
    {
        $teachers = Teacher::get();
        return view('teacher.index', compact('teachers'));
    }

    public function create()
    {
        return view('teacher.create');
    }

    public function store()
    {
        if (Teacher::insert_new()) {
            return redirect(route('teachers.index'));
        }

        return back();
    }

    public function edit(Teacher $teacher)
    {
        return view('teacher.edit', compact('teacher'));
    }

    public function update(Teacher $teacher)
    {
        if (Teacher::change($teacher)) {
            return redirect(route('teachers.index'));
        }

        return back();
    }

    public function delete(Teacher $teacher)
    {
        if (Teacher::remove($teacher)) {
            return redirect(route('teachers.index'));
        }

        return back();
    }
}
