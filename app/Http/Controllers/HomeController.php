<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __invoke(Request $request)
    {
        if (
            !(
                auth('admin')->check() ||
                auth('student')->check() ||
                auth('teacher')->check()
            )
        ) {
            return redirect(route('default'));
        }

        $role = '';
        $name = '';

        if (auth('admin')->check()) {
            $role = 'Admin';
            $name = $request->user('admin')->admin_number ?? '';
        } else if (auth('student')->check()) {
            $role = 'Siswa';
            $name = $request->user('student')->name ?? '';
        } else if (auth('teacher')->check()) {
            $role = 'Guru';
            $name = $request->user('teacher')->name ?? '';
        }

        return view('home', compact('role', 'name'));
    }
}
