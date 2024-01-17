<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class Student extends User
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'name',
        'gender',
        'address',
        'class_id',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function username()
    {
        return 'nis';
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'class_id', 'id');
    }

    public function points()
    {
        return $this->hasMany(Point::class, 'student_id', 'id');
    }

    public static function get()
    {
        $students = self::
            with(['kelas:id,grade,group,major'])->
            select(['students.id', 'nis', 'name', 'gender', 'address', 'password', 'class_id'])->
            orderBy('name')->
            join('classes', 'classes.id', '=', 'students.class_id')->
            orderBy('classes.major')->orderBy('classes.grade')->orderBy('classes.group')->
            get();

        foreach ($students as &$student) {
            $student['password'] = 'secrete';
        }

        return $students;
    }

    public static function get_classes()
    {
        $classes = Kelas::select(['id', 'grade', 'group', 'major'])->orderBy('major')->orderBy('grade')->orderBy('group')->get();
        return $classes;
    }

    public static function insert_new()
    {
        $validated = request()->validate([
            'nis' => ['required', 'numeric', 'digits_between:8,16', Rule::unique('students', 'nis')],
            'name' => ['required', 'regex:/^[A-Z][a-z]+((\s[A-Z][a-z]+)*)$/u', 'max:32'],
            'gender' => ['required', 'in:M,F'],
            'address' => ['required'],
            'class_id' => ['required', Rule::exists('classes', 'id')],
            'password' => ['required', Password::default()],
        ]);

        try {
            $validated['password'] = Hash::make($validated['password']);

            self::create($validated);

            request()->session()->flash('success', 'Success add student');

            return true;
        } catch (\Throwable $th) {
            request()->session()->flash('danger', 'Fail to add student');
            return false;
        }
    }

    public static function change(self $student)
    {
        $validated = request()->validate([
            'nis' => ['required', 'numeric', 'digits_between:8,16', Rule::unique('students', 'nis')->ignore($student->id, 'id')],
            'name' => ['required', 'regex:/^[A-Z][a-z]+((\s[A-Z][a-z]+)*)$/u', 'max:32'],
            'gender' => ['required', 'in:M,F'],
            'address' => ['required'],
            'class_id' => ['required', Rule::exists('classes', 'id')],
            'password' => ['required', Password::default()],
        ]);

        try {
            if (!is_null(request()->new_password)) {
                $validated['password'] = Hash::make(request()->new_password);
            }

            request()->session()->flash('success', 'Success update student');

            return $student->updateOrFail($validated);
        } catch (\Throwable $th) {
            request()->session()->flash('danger', 'Failed update student');
            return false;
        }
    }

    public static function remove(self $student)
    {
        try {
            $exists_in_points_table = $student->points()->exists();

            if ($exists_in_points_table) {
                request()->session()->flash('danger', "Subject {$student->name} is in used");
                return false;
            }

            request()->session()->flash('success', 'Success delete student');
            return $student->deleteOrFail();
        } catch (\Throwable $th) {
            request()->session()->flash('danger', 'Failed delete student');
            return false;
        }
    }
}
