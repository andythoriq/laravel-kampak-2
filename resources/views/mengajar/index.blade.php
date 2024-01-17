@extends('layouts.main', ['title' => 'Teaching'])

@section('content')
    <center>
        <h2>Teaching</h2>
        <a href="{{ route('teachings.create') }}" class="button-primary">ADD DATA</a>
        <x-alert />
        <table class="table-data">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Teacher</th>
                    <th>Subject</th>
                    <th>Class</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody style="font-weight:600">
                @foreach ($teachings as $teaching)
                <?php
                    $teacher = $teaching->teacher;
                    $class = $teaching->kelas;
                ?>
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $teacher->name }} - {{ $teacher->nip }}</td>
                        <td>{{ $teaching->subject->label }}</td>
                        <td>{{ $class->grade }} {{ $class->major }} {{ $class->group }}</td>
                        <td style="text-align: center">
                            <a href="{{ route('teachings.edit', $teaching->id) }}" class="button-warning">EDIT</a>
                            <form action="{{ route('teachings.destroy', $teaching->id) }}" style="display: inline" method="POST">
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
