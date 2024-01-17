@extends('layouts.main', ['title' => 'Student'])

@section('content')
    <div class="container-form">
        <h2 align="center">Add Student</h2>

        <x-alert />

        <form action="{{ route('students.store') }}" method="POST" autocomplete="off">
            @csrf
            <label for="nis">Nis</label>
            <input type="number" name="nis" id="nis" value="{{ old('nis') }}" autofocus required />
            @error('nis')
                <br><span style="color: red">{{ $message }}</span>
            @enderror

            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required />
            @error('name')
                <br><span style="color: red">{{ $message }}</span>
            @enderror

            <label>Gender</label>
            <div style="margin-bottom: 8px">
                <input required type="radio" name="gender" value="M" id="gender_M" {{ old('gender') == 'M' ? 'checked' : '' }}> <label style="display: inline" for="gender_M">Male</label>
                <input type="radio" name="gender" value="F" id="gender_F" {{ old('gender') == 'F' ? 'checked' : '' }}> <label style="display: inline" for="gender_F">Female</label>
            </div>
            @error('gender')
                <br><span style="color: red">{{ $message }}</span>
            @enderror

            <label for="address">Address</label>
            <textarea name="address" rows="5" id="address" required>{{ old('address') }}</textarea>
            @error('address')
                <br><span style="color: red">{{ $message }}</span>
            @enderror

            <label for="class_id">Class</label>
            <select name="class_id" id="class_id">
                <option value="">-- choosse class --</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->grade }} {{ $class->major }} {{ $class->group }}</option>
                @endforeach
             </select>
            @error('class_id')
                <br><span style="color: red">{{ $message }}</span>
            @enderror

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            @error('password')
                <br><span style="color: red">{{ $message }}</span>
            @enderror

            <button class="button-submit" type="submit">Submit</button>
        </form>
    </div>
@endsection
