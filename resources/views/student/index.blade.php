@extends('layouts.main', ['title' => 'Student'])

@section('content')
    <center>
        <h2>Student</h2>
        <a href="{{ route('students.create') }}" class="button-primary">ADD DATA</a>
        <x-alert />
        <table class="table-data">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIS</th>
                    <th>NAME</th>
                    <th>GENDER</th>
                    <th>ADDRESS</th>
                    <th>CLASS</th>
                    <th>PASSWORD</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody style="font-weight: 600">
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $student->nis }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->gender == 'M' ? 'M': 'F' }}</td>
                        <td>{{ $student->address }}</td>
                        <td>{{ $student->kelas->grade }} {{ $student->kelas->major }} {{ $student->kelas->group }}</td>
                        <td><i><center>{{ $student->password }}</center></i></td>
                        <td style="text-align: center">
                            <a href="{{ route('students.edit', $student->id) }}" class="button-warning">EDIT</a>
                            <form action="{{ route('students.destroy', $student->id) }}" style="display: inline" method="POST">
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
