@extends('layouts.main', ['title' => 'Subject'])

@section('content')
    <center>
        <h2>Subject</h2>
        <a href="{{ route('subjects.create') }}" class="button-primary">ADD DATA</a>
        <x-alert />
        <table class="table-data">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>SUBJECT TITLE</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody style="font-weight: 700">
                @foreach ($subjects as $subject)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $subject->label }}</td>
                        <td style="text-align: center">
                            <a href="{{ route('subjects.edit', $subject->id) }}" class="button-warning">EDIT</a>
                            <form action="{{ route('subjects.destroy', $subject->id) }}" style="display: inline" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('You Sure?')" class="button-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </center>
@endsection
