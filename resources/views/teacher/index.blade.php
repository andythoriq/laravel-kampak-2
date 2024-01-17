@extends('layouts.main', ['title' => 'Teacher'])

@section('content')
    <center>
        <h2>Teacher</h2>
        <a href="{{ route('teachers.create') }}" class="button-primary">ADD DATA</a>
        <x-alert />
        <table class="table-data">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIP</th>
                    <th>NAME</th>
                    <th>GENDER</th>
                    <th>ADDRESS</th>
                    <th>PASSWORD</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody style="font-weight: 600">
                @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $teacher->nip }}</td>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->gender == 'M' ? 'M': 'F' }}</td>
                        <td>{{ $teacher->address }}</td>
                        <td><i><center>{{ $teacher->password }}</center></i></td>
                        <td style="text-align: center">
                            <a href="{{ route('teachers.edit', $teacher->id) }}" class="button-warning">EDIT</a>
                            <form action="{{ route('teachers.destroy', $teacher->id) }}" style="display: inline" method="POST">
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
