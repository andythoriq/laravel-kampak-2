<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'teaching_id',
        'student_id',
        'uh',
        'uts',
        'uas',
        'na',
    ];

    public function teaching()
    {
        return $this->belongsTo(Teaching::class, 'teaching_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public static function get_current_classes()
    {
        $class_ids = [];
        $teacher = Teacher::find(auth('teacher')->id());

        foreach ($teacher->teachings as $teaching) {
            array_push($class_ids, $teaching->class_id);
        }

        $classes = Kelas::whereIn('id', $class_ids)->get();

        return $classes;
    }

    public static function get_class_by_format($format)
    {
        $exploded = explode('_', $format);

        try {
            $class_id = Kelas::select('id')->where('grade', $exploded[0])->where('major', $exploded[1])->where('group', $exploded[2])->firstOrFail();
        } catch (\Throwable $th) {
            abort(404, 'Class not found');
        }

        return $class_id->id;
    }

    public static function get_nilai_by_class($class_id)
    {
        $teacher_id = auth('teacher')->id();

        $nilai = self::with(['teaching:id,teacher_id,subject_id', 'student:id,name,nis'])->select(['id', 'teaching_id', 'student_id', 'uh', 'uts', 'uas', 'na'])
            ->whereHas('teaching', function ($query) use ($class_id, $teacher_id) {
                $query->with(['subject:id,label', 'teacher:id,name,nip'])
                    ->select(['id', 'teacher_id', 'subject_id'])
                    ->where('class_id', $class_id)
                    ->where('teacher_id', $teacher_id);
            })->get();

        return $nilai;
    }

    public static function get_nilai_by_student()
    {
        $student = Student::select(['id', 'class_id'])->where('id', auth('student')->id())->first();

        $nilai = self::
            with(['teaching:id,teacher_id,subject_id,class_id', 'student:id,name,nis'])->
            select(['id', 'teaching_id', 'student_id', 'uh', 'uts', 'uas', 'na'])->
            whereHas('teaching', function ($query) use ($student) {
                $query->with(['subject:id,label', 'teacher:id,name,nip', 'kelas:id'])->
                    select(['id', 'teacher_id', 'subject_id', 'class_id'])->
                    where('class_id', $student->class_id);
            })->
            where('student_id', $student->id)->
            get();

        return $nilai;
    }

    public static function get_teachings_by_class($class_id)
    {
        return Teaching::with(['teacher:id,name,nip', 'subject:id,label'])
            ->select(['id', 'teacher_id', 'class_id', 'subject_id'])
            ->where('teacher_id', auth('teacher')->id())
            ->where('class_id', $class_id)->get();
    }

    public static function get_students_by_class($class_id)
    {
        return Student::select(['id', 'nis', 'name', 'class_id'])->where('class_id', $class_id)->get();
    }

    public static function insert_new()
    {
        $validated = request()->validate([
            'teaching_id' => ['required', Rule::exists('teachings', 'id')],
            'student_id' => ['required', Rule::exists('students', 'id')],
            'uh' => ['required', 'numeric', 'min:0', 'max:100'],
            'uts' => ['required', 'numeric', 'min:0', 'max:100'],
            'uas' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        $validated['na'] = round(((float) $validated['uh'] + (float) $validated['uts'] + (float) $validated['uas']) / 3);

        try {
            $nilai_exists = self::where('teaching_id', $validated['teaching_id'])
                ->where('student_id', $validated['student_id'])->exists();

            if ($nilai_exists) {
                request()->session()->flash('danger', 'Nilai already exists');
                return false;
            } else {
                self::create($validated);
                request()->session()->flash('success', 'Success add nilai');
                return true;
            }
        } catch (\Throwable $th) {
            request()->session()->flash('danger', 'Failed delete nilai');
            return false;
        }
    }

    public static function change(self $point)
    {
        $validated = request()->validate([
            'teaching_id' => ['required', Rule::exists('teachings', 'id')],
            'student_id' => ['required', Rule::exists('students', 'id')],
            'uh' => ['required', 'numeric', 'min:0', 'max:100'],
            'uts' => ['required', 'numeric', 'min:0', 'max:100'],
            'uas' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        $validated['na'] = round(((float) $validated['uh'] + (float) $validated['uts'] + (float) $validated['uas']) / 3);

        if ($validated['teaching_id'] != $point->teaching_id || $validated['student_id'] != $point->student_id) {
            if (self::where('teaching_id', $validated['teaching_id'])->where('student_id', $validated['student_id'])->exists()) {
                request()->session()->flash('danger', 'Nilai already exists');
                return false;
            }
        }

        try {
            request()->session()->flash('success', 'Success update nilai');
            return $point->updateOrFail($validated);
        } catch (\Throwable $th) {
            request()->session()->flash('danger', 'Fail update nilai');
            return false;
        }
    }

    public static function remove(self $point)
    {
        try {
            request()->session()->flash('success', 'Success delete nilai');
            return $point->deleteOrFail();
        } catch (\Throwable $th) {
            request()->session()->flash('danger', 'Failed delete nilai');
            return false;
        }
    }
}
