@extends('layouts.main', ['title' => 'nilai'])

@section('content')
    <center>
        <h2>List Data Nilai</h2>
        @auth('teacher')
            <a href="{{ route('points.create', ['format' => $format]) }}" class="button-primary">TAMBAH DATA</a>
        @endauth
        <x-alert />
        <table class="table-data">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Teacher</th>
                    <th>Subject</th>
                    <th>Student</th>
                    <th>UH</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th>NA</th>
                    @auth('teacher')
                        <th>ACTION</th>
                    @endauth
                </tr>
            </thead>
            <tbody style="font-weight: 600">
                @foreach ($points as $point)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $point->teaching->teacher->name }} - {{ $point->teaching->teacher->nip }}</td>
                        <td>{{ $point->teaching->subject->label }}</td>
                        <td>{{ $point->student->name }} - {{ $point->student->nis }}</td>
                        <td>{{ $point->uh }}</td>
                        <td>{{ $point->uts }}</td>
                        <td>{{ $point->uas }}</td>
                        <td>{{ $point->na }}</td>
                        @auth('teacher')
                            <td style="text-align: center">
                                <a href="{{ route('points.edit', ['format' => $format, 'point' => $point->id]) }}" class="button-warning">EDIT</a>
                                <a href="{{ route('points.destroy', ['format' => $format, 'point' => $point->id]) }}" onclick="return confirm('You Sure')" class="button-danger">HAPUS</a>
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    </center>
@endsection
