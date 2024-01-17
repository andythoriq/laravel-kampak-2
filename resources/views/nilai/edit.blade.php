@extends('layouts.main', ['title' => 'Nilai'])

@section('content')
    <div class="container-form">
        <h2 align="center">Edit Nilai</h2>
        <x-alert />
        <form action="{{ route('points.update', ['format' => $format, 'point' => $point->id]) }}" method="post" autocomplete="off">
            @csrf
            @method('PUT')
            <label for="teaching_id">Teacher</label>
            <select name="teaching_id" id="teaching_id" autofocus>
                @foreach ($teachings as $teaching)
                    <option value="{{ $teaching->id }}" @if(old('teaching_id', $teaching->id) == $point->teaching_id) selected @endif>{{ $teaching->subject->label }}</option>
                @endforeach
            </select>

            <label for="student_id">Student</label>
            <select name="student_id" id="student_id">
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" @if(old('student_id', $student->id) == $point->student_id) selected @endif>{{ $student->name }} {{ $student->nis }}</option>
                @endforeach
            </select>

            <label for="uh">UH</label>
            <input type="number" name="uh" id="uh" min="0" max="100" value="{{old('uh', $point->uh ?? '')}}" />
            <label for="uts">UTS</label>
            <input type="number" name="uts" id="uts" min="0" max="100" value="{{old('uts', $point->uts ?? '')}}" />
            <label for="uas">UAS</label>
            <input type="number" name="uas" id="uas" min="0" max="100" value="{{old('uas', $point->uas ?? '')}}" />

            <button class="button-submit" type="submit">Submit</button>
        </form>
    </div>
@endsection
