<?php

namespace App\Http\Controllers;

use App\Models\Teaching;

// use Illuminate\Http\Request;

class TrxMengajarControl extends Controller
{
    public function index()
    {
        $teachings = Teaching::get();
        return view('mengajar.index', compact('teachings'));
    }

    public function create()
    {
        $classes = Teaching::get_classes();
        $subjects = Teaching::get_subjects();
        $teachers = Teaching::get_teachers();
        return view('mengajar.create', compact('classes', 'subjects', 'teachers'));
    }

    public function store()
    {
        if (Teaching::insert_new()) {
            return redirect(route('teachings.index'));
        }

        return back();
    }

    public function edit(Teaching $teaching)
    {
        $classes = Teaching::get_classes();
        $subjects = Teaching::get_subjects();
        $teachers = Teaching::get_teachers();
        return view('mengajar.edit', compact('teaching', 'classes', 'subjects', 'teachers'));
    }

    public function update(Teaching $teaching)
    {
        if (Teaching::change($teaching)) {
            return redirect(route('teachings.index'));
        }

        return back();
    }

    public function delete(Teaching $teaching)
    {
        if (Teaching::remove($teaching)) {
            return redirect(route('teachings.index'));
        }

        return back();
    }
}
