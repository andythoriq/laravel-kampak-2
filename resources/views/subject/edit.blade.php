@extends('layouts.main', ['title' => 'Subject'])

@section('content')
    <div class="container-form">
        <h2 align="center">Edit Subject</h2>

        <x-alert />

        <form action="{{ route('subjects.update', $subject->id) }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')

            <label for="label">label</label>
            <input type="text" name="label" id="label" value="{{ old('label', $subject->label ?? '') }}" autofocus required />
            @error('label')
                <br><span style="color: red">{{ $message }}</span>
            @enderror

            <button class="button-submit" type="submit">Submit</button>
        </form>
    </div>
@endsection
