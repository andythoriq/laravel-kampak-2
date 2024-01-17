@extends('layouts.main', ['title' => 'Class'])

@section('content')
    <div class="container-form">
        <h2 align="center">Add Class</h2>

        <x-alert />

        <form action="{{ route('classes.store') }}" method="POST" autocomplete="off">
            @csrf

            <label for="grade">GRADE</label>
            <select name="grade" autofocus>
                <option value="">-- choose grade --</option>
                @foreach ($grades as $grade)
                    <option value="{{ $grade }}" {{ old('grade') == $grade ? 'selected' : '' }}>grade {{ $grade }}</option>
                @endforeach
            </select>
            @error('grade')
                <br><span style="color: red">{{ $message }}</span>
            @enderror

            <label for="major">MAJOR</label>
            <select name="major">
                <option value="">-- choose major --</option>
                @foreach ($majors as $major)
                    <option value="{{ $major }}" {{ old('major') == $major ? 'selected' : '' }}>{{ $major }}</option>
                @endforeach
            </select>
            @error('major')
                <br><span style="color: red">{{ $message }}</span>
            @enderror

            <label for="group">GROUP</label>
            <select name="group">
                <option value="">-- choose group --</option>
                @foreach ($groups as $group)
                    <option value="{{ $group }}" {{ old('group') == $group ? 'selected' : '' }}>group {{ $group }}</option>
                @endforeach
            </select>
            @error('group')
                <br><span style="color: red">{{ $message }}</span>
            @enderror

            <button class="button-submit" type="submit">Submit</button>
        </form>
    </div>
@endsection
