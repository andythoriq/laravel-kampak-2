@extends('layouts.main', ['title' => 'Class'])

@section('content')
    <div class="container-form">
        <h2 align="center">Edit Class</h2>

        <x-alert />

        <form action="{{ route('classes.update', $class->id) }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')

            <label for="grade">GRADE</label>
            <select name="grade" autofocus>
                <option value="">-- choose grade --</option>
                @foreach ($grades as $grade)
                    <option value="{{ $grade }}" {{ old('grade', $class->grade) == $grade ? 'selected' : '' }}>grade {{ $grade }}</option>
                @endforeach
            </select>
            @error('grade')
                <br><span style="color: red">{{ $message }}</span>
            @enderror

            <label for="major">MAJOR</label>
            <select name="major">
                <option value="">-- choose major --</option>
                @foreach ($majors as $major)
                    <option value="{{ $major }}" {{ old('major', $class->major) == $major ? 'selected' : '' }}>{{ $major }}</option>
                @endforeach
            </select>
            @error('major')
                <br><span style="color: red">{{ $message }}</span>
            @enderror

            <label for="group">GROUP</label>
            <select name="group">
                <option value="">-- choose group --</option>
                @foreach ($groups as $group)
                    <option value="{{ $group }}" {{ old('group', $class->group) == $group ? 'selected' : '' }}>group {{ $group }}</option>
                @endforeach
            </select>
            @error('group')
                <br><span style="color: red">{{ $message }}</span>
            @enderror

            <button class="button-submit" type="submit">Submit</button>
        </form>
    </div>
@endsection
