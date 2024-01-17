<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Teaching extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'subject_id',
        'class_id',
    ];


    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'class_id', 'id');
    }

    public static function get()
    {
        $teachings = self::
            with(['teacher:id,name,nip', 'subject:id,label', 'kelas:id,grade,major,group'])->
            select(['teachings.id', 'teacher_id', 'subject_id', 'class_id'])->
            join('teachers', 'teachers.id', '=', 'teachings.teacher_id')->
            orderBy('teachers.name')->
            join('subjects', 'subjects.id', '=', 'teachings.subject_id')->
            orderBy('subjects.label')->
            join('classes', 'classes.id', '=', 'teachings.class_id')->
            orderBy('classes.major')->orderBy('classes.grade')->orderBy('classes.group')->
            get();

        return $teachings;
    }

    public static function get_teachers()
    {
        return Teacher::select(['id', 'nip', 'name'])->orderBy('name')->get();
    }

    public static function get_subjects()
    {
        return Subject::select(['id', 'label'])->orderBy('label')->get();
    }

    public static function get_classes()
    {
        return Kelas::select(['id', 'grade', 'major', 'group'])->orderBy('major')->orderBy('grade')->orderBy('group')->get();
    }

    public static function insert_new(): bool
    {
        $validated = request()->validate([
            'teacher_id' => ['required', Rule::exists('teachers', 'id')],
            'subject_id' => ['required', Rule::exists('subjects', 'id')],
            'class_id' => ['required', Rule::exists('classes', 'id')],
        ]);

        try {
            $is_same_as_in_table = self::where('teacher_id', $validated['teacher_id'])
                ->where('subject_id', $validated['subject_id'])
                ->where('class_id', $validated['class_id'])
                ->exists();

            $is_class_and_subject_same = self::where('subject_id', $validated['subject_id'])
                ->where('class_id', $validated['class_id'])
                ->exists();

            if ($is_same_as_in_table) {
                request()->session()->flash('danger', 'Teaching is already exists');
                return false;
            }

            if ($is_class_and_subject_same) {
                request()->session()->flash('danger', 'Class and Subject are already used');
                return false;
            }

            self::create($validated);
            request()->session()->flash('success', 'Success add teaching');
            return true;
        } catch (\Throwable $th) {
            request()->session()->flash('danger', 'Fail to add teaching');
            return false;
        }
    }

    public static function change(self $teaching): bool
    {
        $validated = request()->validate([
            'teacher_id' => ['required', Rule::exists('teachers', 'id')],
            'subject_id' => ['required', Rule::exists('subjects', 'id')],
            'class_id' => ['required', Rule::exists('classes', 'id')],
        ]);

        try {
            if (
                $validated['teacher_id'] != $teaching->teacher_id ||
                $validated['subject_id'] != $teaching->subject_id ||
                $validated['class_id'] != $teaching->class_id
            ) {
                $is_same_as_in_table = self::where('subject_id', $validated['subject_id'])
                    ->where('teacher_id', $validated['teacher_id'])
                    ->where('class_id', $validated['class_id'])
                    ->exists();

                $is_class_and_subject_same = self::where('subject_id', $validated['subject_id'])
                    ->where('class_id', $validated['class_id'])
                    ->exists();

                if ($is_same_as_in_table) {
                    request()->session()->flash('danger', 'Teaching is already exists');
                    return false;
                }

                if ($is_class_and_subject_same) {
                    request()->session()->flash('danger', 'Class and Subject are already used');
                    return false;
                }
            }

            request()->session()->flash('success', 'Success update teaching');
            return $teaching->updateOrFail($validated);
        } catch (\Throwable $th) {
            request()->session()->flash('danger', 'Failed update teaching');
            return false;
        }
    }

    public static function remove(self $teaching)
    {
        try {
            request()->session()->flash('success', 'Success delete teaching');
            return $teaching->deleteOrFail();
        } catch (\Throwable $th) {
            request()->session()->flash('danger', 'Failed delete teaching');
            return false;
        }
    }
}
