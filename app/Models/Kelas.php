<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'grade',
        'major',
        'group',
    ];

    public static $grades = ['10', '11', '12', '13'];

    public static $majors = ['DKV', 'BKP', 'DPIB', 'RPL', 'SIJA', 'TKJ', 'TP', 'TOI', 'TKRO', 'TFLM'];

    public static $groups = ['1', '2', '3', '4'];

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id', 'id');
    }

    public function teachings()
    {
        return $this->hasMany(Teaching::class, 'class_id', 'id');
    }

    public static function get()
    {
        return self::select(['id', 'grade', 'major', 'group'])
            ->orderBy('major')->orderBy('grade')->orderBy('group')->get();
    }

    public static function insert_new()
    {
        $validated = request()->validate([
            'grade' => ['required', Rule::in(self::$grades)],
            'major' => ['required', Rule::in(self::$majors)],
            'group' => ['required', Rule::in(self::$groups)],
        ]);

        try {
            $is_same_as_in_table = self::where('grade', $validated['grade'])
                ->where('major', $validated['major'])
                ->where('group', $validated['group'])
                ->exists();

            if ($is_same_as_in_table) {
                request()->session()->flash('danger', 'The class is already exists');
                return false;
            }

            self::create($validated);
            request()->session()->flash('success', 'Success add class');
            return true;
        } catch (\Throwable $th) {
            request()->session()->flash('danger', 'Fail to add Class');
            return false;
        }
    }

    public static function change(self $class)
    {
        $validated = request()->validate([
            'grade' => ['required', Rule::in(self::$grades)],
            'major' => ['required', Rule::in(self::$majors)],
            'group' => ['required', Rule::in(self::$groups)],
        ]);

        try {
            if (
                $validated['grade'] != $class->grade ||
                $validated['major'] != $class->major ||
                $validated['group'] != $class->group
            ) {
                $is_same_as_in_table = self::where('grade', request()->grade)
                    ->where('major', request()->major)
                    ->where('group', request()->group)
                    ->exists();

                if ($is_same_as_in_table) {
                    request()->session()->flash('danger', 'The class is already exists');
                    return false;
                }
            }

            request()->session()->flash('success', 'Success update class');

            return $class->updateOrFail($validated);
        } catch (\Throwable $th) {
            request()->session()->flash('danger', 'Failed update class');
            return false;
        }
    }

    public static function remove(self $class)
    {
        try {
            if (!self::where('id', $class->id)->exists()) {
                request()->session()->flash('danger', 'Class is not found');
                return false;
            }

            if ($class->teachings()->exists()) {
                request()->session()->flash('danger', "{$class->grade} {$class->major} {$class->group} is being used in teaching");
                return false;
            }

            if ($class->students()->exists()) {
                request()->session()->flash('danger', "{$class->grade} {$class->major} {$class->group} is being used in teaching");
                return false;
            }

            request()->session()->flash('success', 'Success delete class');
            return $class->deleteOrFail();
        } catch (\Throwable $th) {
            request()->session()->flash('danger', 'Failed delete class');
            return false;
        }
    }
}
