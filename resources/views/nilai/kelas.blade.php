@extends('layouts.main',  ['title' => 'Kelas'])

@section('content')
    @if ($classes->count() > 0)
        <div class="content-menu">
            @foreach ($classes as $class)
                <div class="menu-kelas">
                    <div class="kelas-list">
                        <?php $format = "{$class->grade}_{$class->major}_{$class->group}" ?>
                        <a href="{{ route('points.class', $format) }}">
                            {{ $class->grade }} {{ $class->major }} {{ $class->group }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h2>
            <center>
                You dont have any class
            </center>
        </h2>
    @endif
@endsection
