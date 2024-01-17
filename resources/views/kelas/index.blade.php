@extends('layouts.main', ['title' => 'Class'])

@section('content')
    <center>
        <h2>Class</h2>
        <a href="{{ route('classes.create') }}" class="button-primary">ADD DATA</a>
        <x-alert />
        <table class="table-data">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>GRADE</th>
                    <th>JURUSAN</th>
                    <th>GROUP</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody style="font-weight:700">
                @foreach ($classes as $class)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $class->grade }}</td>
                        <td>{{ $class->major }}</td>
                        <td>{{ $class->group }}</td>
                        <td style="text-align: center">
                            <a href="{{ route('classes.edit', $class->id) }}" class="button-warning">EDIT</a>
                            <form action="{{ route('classes.destroy', $class->id) }}" style="display: inline" method="POST">
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
