<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class Teacher extends User
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'name',
        'gender',
        'address',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function username()
    {
        return 'nip';
    }

    public function teachings()
    {
        return $this->hasMany(Teaching::class, 'teacher_id', 'id');
    }

    public static function get()
    {
        $teachers = self::select(['id', 'nip', 'name', 'gender', 'address', 'password'])->get();

        foreach ($teachers as &$teacher) {
            $teacher['password'] = 'secrete';
        }

        return $teachers;
    }

    public static function insert_new(): bool
    {
        $validated = request()->validate([
            'nip' => ['required', 'numeric', 'digits_between:8,16', Rule::unique('teachers', 'nip')],
            'name' => ['required', 'regex:/^[A-Z][a-z]+((\s[A-Z][a-z]+)*)$/u', 'max:32'],
            'gender' => ['required', 'in:M,F'],
            'address' => ['required'],
            'password' => ['required', Password::default()],
        ]);

        try {
            $validated['password'] = Hash::make($validated['password']);

            self::create($validated);

            request()->session()->flash('success', 'Success add teacher');

            return true;
        } catch (\Throwable $th) {
            request()->session()->flash('danger', 'Fail to add teacher');
            return false;
        }
    }

    public static function change(self $teacher): bool
    {
        $validated = request()->validate([
            'nip' => ['required', 'numeric', 'digits_between:8,16', Rule::unique('teachers', 'nip')->ignore($teacher->id, 'id')],
            'name' => ['required', 'regex:/^[A-Z][a-z]+((\s[A-Z][a-z]+)*)$/u', 'max:32'],
            'gender' => ['required', 'in:M,F'],
            'address' => ['required'],
            'password' => ['required'],
        ]);

        try {
            if (!is_null(request()->new_password)) {
                $validated['password'] = Hash::make(request()->new_password);
            }

            request()->session()->flash('success', 'Success update teacher');

            return $teacher->updateOrFail($validated);
        } catch (\Throwable $th) {
            request()->session()->flash('danger', 'Failed update teacher');
            return false;
        }
    }

    public static function remove(self $teacher)
    {
        try {
            $teaching = $teacher->teachings()->exists();

            if ($teaching) {
                request()->session()->flash('danger', "Subject {$teacher->name} is in used");
                return false;
            }

            request()->session()->flash('success', 'Success delete teacher');
            return $teacher->deleteOrFail();
        } catch (\Throwable $th) {
            request()->session()->flash('danger', 'Failed delete teacher');
            return false;
        }
    }
}
