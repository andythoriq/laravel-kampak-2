@extends('layouts.main', ['title' => 'Teaching'])

@section('content')
    <div class="container-form">
        <h2 align="center">Edit Teaching</h2>

        <x-alert />

        <form action="{{ route('teachings.update', $teaching->id) }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')

            <label for="teacher_id">Teacher</label>
            <select name="teacher_id" id="teacher_id" autofocus>
                <option value="">-- choosse teacher --</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ old('teacher_id', $teaching->teacher_id) == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }} {{ $teacher->nip }}</option>
                @endforeach
             </select>
            @error('teacher_id')
                <br><span style="color: red">{{ $message }}</span>
            @enderror

            <label for="subject_id">Subject</label>
            <select name="subject_id" id="subject_id">
                <option value="">-- choosse subject --</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ old('subject_id', $teaching->subject_id) == $subject->id ? 'selected' : '' }}>{{ $subject->label }}</option>
                @endforeach
             </select>
            @error('subject_id')
                <br><span style="color: red">{{ $message }}</span>
            @enderror

            <label for="class_id">Class</label>
            <select name="class_id" id="class_id">
                <option value="">-- choosse class --</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}" {{ old('class_id', $teaching->class_id) == $class->id ? 'selected' : '' }}>{{ $class->grade }} {{ $class->major }} {{ $class->group }}</option>
                @endforeach
             </select>
            @error('class_id')
                <br><span style="color: red">{{ $message }}</span>
            @enderror

            <button class="button-submit" type="submit">Submit</button>
        </form>
    </div>
@endsection
