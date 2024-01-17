<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

// use Illuminate\Http\Request;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
    ];

    public function teachings()
    {
        return $this->hasMany(Teaching::class, 'subject_id', 'id');
    }

    public static function get()
    {
        return self::select(['id', 'label'])->orderBy('label')->get();
    }

    public static function insert_new(): bool
    {
        $validated = request()->validate([
            'label' => ['required', 'regex:/^[A-Z][a-z]+((\s[A-Z][a-z]+)*)$/u', 'max:32', Rule::unique('subjects', 'label')]
        ]);

        try {
            self::create($validated);

            request()->session()->flash('success', 'Success add subject');
            return true;
        } catch (\Throwable $th) {
            request()->session()->flash('danger', 'Fail to add subject');
            return false;
        }
    }

    public static function change(self $subject): bool
    {
        $validated = request()->validate([
            'label' => ['required', 'regex:/^[A-Z][a-z]+((\s[A-Z][a-z]+)*)$/u', 'max:32', Rule::unique('subjects', 'label')->ignore($subject->id, 'id')]
        ]);

        try {
            request()->session()->flash('success', 'Success update subject');

            return $subject->updateOrFail($validated);
        } catch (\Throwable $th) {
            request()->session()->flash('danger', 'Failed update subject');
            return false;
        }
    }

    public static function remove(self $subject): bool
    {
        try {
            $taught = $subject->teachings()->exists();

            if ($taught) {
                request()->session()->flash('danger', "Subject {$subject->label} is in used");
                return false;
            }

            request()->session()->flash('success', 'Success delete subject');
            return $subject->deleteOrFail();
        } catch (\Throwable $th) {
            request()->session()->flash('danger', 'Failed delete subject');
            return false;
        }
    }
}
