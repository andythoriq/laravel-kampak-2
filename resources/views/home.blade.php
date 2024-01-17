@extends('layouts.main', ['title' => "Welcome $name"])

@section('content')
    <center>
        <x-alert />
        <h1>
            Selamat datang {{ $role }},
            {{ $name }}
        </h1>
    </center>
@endsection
