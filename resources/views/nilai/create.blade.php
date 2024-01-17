@extends('layouts.main', ['title' => 'Nilai'])
@section('content')
    <div class="container-form">
        <h2 align="center">Tambah Data Nilai</h2>
        <x-alert />
        <form action="{{ route('points.store', $format) }}" method="post" autocomplete="off">
            @csrf
            <label for="teaching_id">Guru Mapel</label>
            <select name="teaching_id" id="teaching_id" autofocus>
                <option value="">-- choose teaching --</option>
                @foreach ($teachings as $teaching)
                    <option value="{{ $teaching->id }}" @if(old('teaching_id')) selected @endif>{{ $teaching->subject->label }}</option>
                @endforeach
            </select>

            <label for="student_id">Student</label>
            <select name="student_id" id="student_id">
                <option value="">-- choose student --</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" @if(old('student_id')) selected @endif>{{ $student->name }} {{ $student->nis }}</option>
                @endforeach
            </select>

            <label for="uh">UH</label>
            <input type="number" name="uh" id="uh" min="0" max="100" />
            <label for="uts">UTS</label>
            <input type="number" name="uts" id="uts" min="0" max="100" />
            <label for="uas">UAS</label>
            <input type="number" name="uas" id="uas" min="0" max="100" />

            <button class="button-submit" type="submit">Submit</button>
        </form>
    </div>
@endsection
