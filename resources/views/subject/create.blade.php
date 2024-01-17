@extends('layouts.main', ['title' => 'Subject'])

@section('content')
    <div class="container-form">
        <h2 align="center">Add Subject</h2>

        <x-alert />

        <form action="{{ route('subjects.store') }}" method="POST" autocomplete="off">
            @csrf

            <label for="label">Subject or Lecture Name</label>
            <input type="text" name="label" id="label" value="{{ old('label') }}" autofocus required />
            @error('label')
                <br><span style="color: red">{{ $message }}</span>
            @enderror

            <button class="button-submit" type="submit">Submit</button>
        </form>
    </div>
@endsection
