@extends('layouts.main', ['title' => 'Teacher'])

@section('content')
    <div class="container-form">
        <h2 align="center">Add Teacher</h2>

        <x-alert />

        <form action="{{ route('teachers.store') }}" method="POST" autocomplete="off">
            @csrf
            <label for="nip">Nip</label>
            <input type="number" name="nip" id="nip" value="{{ old('nip') }}" autofocus required />
            @error('nip')
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

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            @error('password')
                <br><span style="color: red">{{ $message }}</span>
            @enderror

            <button class="button-submit" type="submit">Submit</button>
        </form>
    </div>
@endsection
