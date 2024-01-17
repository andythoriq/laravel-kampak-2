<?php

namespace App\Http\Controllers;

use App\Models\Subject;

// use Illuminate\Http\Request;

class MasterSubjectControl extends Controller
{
    public function index()
    {
        $subjects = Subject::get();
        return view('subject.index', compact('subjects'));
    }

    public function create()
    {
        return view('subject.create');
    }

    public function store()
    {
        if (Subject::insert_new()) {
            return redirect(route('subjects.index'));
        }

        return back();
    }

    public function edit(Subject $subject)
    {
        return view('subject.edit', compact('subject'));
    }

    public function update(Subject $subject)
    {
        if (Subject::change($subject)) {
            return redirect(route('subjects.index'));
        }

        return back();
    }

    public function delete(Subject $subject)
    {
        if (Subject::remove($subject)) {
            return redirect(route('subjects.index'));
        }

        return back();
    }
}
