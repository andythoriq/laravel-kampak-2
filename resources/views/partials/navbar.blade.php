<div class="menu">
    <a href="{{ route("home") }}" class="{{ (request()->routeIs('home') || request()->routeIs('default')) ? 'active' : '' }}">HOME</a>

    @auth('admin')
        <a href="{{ route('teachers.index') }}" class="{{ request()->routeIs('teachers.*') ? 'active' : '' }}">GURU</a>
        <a href="{{ route('classes.index') }}" class="{{ request()->routeIs('classes.*') ? 'active' : '' }}">KELAS</a>
        <a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.*') ? 'active' : '' }}">SISWA</a>
        <a href="{{ route('subjects.index') }}" class="{{ request()->routeIs('subjects.*') ? 'active' : '' }}">MAPEL</a>
        <a href="{{ route('teachings.index') }}" class="{{ request()->routeIs('teachings.*') ? 'active' : '' }}">MENGAJAR</a>
        <a href="{{ route('logout') }}" onclick="return confirm('You Sure?')">LOGOUT</a>
    @endauth

    @auth('teacher')
        <a href="{{ route('points.index') }}" class="{{ request()->routeIs('points.*') ? 'active' : '' }}">NILAI</a>
        <a href="{{ route('logout') }}" onclick="return confirm('You Sure?')">LOGOUT</a>
    @endauth

    @auth('student')
        <a href="{{ route('nilai') }}" class="{{ request()->routeIs('nilai*') ? 'active' : '' }}">NILAI</a>
        <a href="{{ route('logout') }}" onclick="return confirm('You Sure?')">LOGOUT</a>
    @endauth


</div>
