<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login_admin(Request $request)
    {
        $attr = Admin::where('admin_number', $request->admin_number)->first();

        if (!$attr || !Hash::check($request->password, $attr->password)) {
            return back()->with('danger', 'Your account does not found in our database.');
        }

        Auth::guard('admin')->login($attr);

        return redirect(route('home'))->with('success', 'Success login');
    }

    public function login_student(Request $request)
    {
        $attr = Student::where('nis', $request->nis)->first();

        if (!$attr || !Hash::check($request->password, $attr->password)) {
            return back()->with('danger', 'Your account does not found in our database.');
        }

        Auth::guard('student')->login($attr);

        return redirect(route('home'))->with('success', 'Success login');
    }

    public function login_teacher(Request $request)
    {
        $attr = Teacher::where('nip', $request->nip)->first();

        if (!$attr || !Hash::check($request->password, $attr->password)) {
            return back()->with('danger', 'Your account does not found in our database.');
        }

        Auth::guard('teacher')->login($attr);

        return redirect(route('home'))->with('success', 'Success login');
    }
}
