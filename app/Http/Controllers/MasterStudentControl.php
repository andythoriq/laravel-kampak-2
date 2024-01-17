<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class MasterStudentControl extends Controller
{
    public function index()
    {
        $students = Student::get();
        return view('student.index', compact('students'));
    }

    public function create()
    {
        $classes = Student::get_classes();
        return view('student.create', compact('classes'));
    }

    public function store()
    {
        if (Student::insert_new()) {
            return redirect(route('students.index'));
        }

        return back();
    }

    public function edit(Student $student)
    {
        $classes = Student::get_classes();
        return view('student.edit', compact('student', 'classes'));
    }

    public function update(Student $student)
    {
        if (Student::change($student)) {
            return redirect(route('students.index'));
        }

        return back();
    }

    public function delete(Student $student)
    {
        if (Student::remove($student)) {
            return redirect(route('students.index'));
        }

        return back();
    }
}
