<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Kelas;

class MasterClassControl extends Controller
{
    public function index()
    {
        $classes = Kelas::get();
        return view('kelas.index', compact('classes'));
    }

    public function create()
    {
        return view('kelas.create', [
            'grades' => Kelas::$grades,
            'majors' => Kelas::$majors,
            'groups' => Kelas::$groups,
        ]);
    }

    public function store()
    {
        if (Kelas::insert_new()) {
            return redirect(route('classes.index'));
        }

        return back();
    }

    public function edit(Kelas $class)
    {
        $grades = Kelas::$grades;
        $majors = Kelas::$majors;
        $groups = Kelas::$groups;
        return view('kelas.edit', compact(['class', 'grades', 'majors', 'groups']));
    }

    public function update(Kelas $class)
    {
        if (Kelas::change($class)) {
            return redirect(route('classes.index'));
        }

        return back();
    }

    public function delete(Kelas $class)
    {
        if (Kelas::remove($class)) {
            return redirect(route('classes.index'));
        }

        return back();
    }
}
