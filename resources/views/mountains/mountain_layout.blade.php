@extends('layout.main')
@section('title')
    <title>MountTrek | Mountains Data</title>
@endsection
@section('nav-menu')
    <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link  ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.mountains.index') }}" class="nav-link active">
            <i class="nav-icon fa-solid fa-mountain-sun"></i>
            <p>
                Data Gunung
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.hikingroutes.index') }}" class="nav-link">
            <i class="nav-icon fa-solid fa-route"></i>
            <p>
                Data Rute Pendakian
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.hikings.index') }}" class="nav-link ">
            <i class="nav-icon fa-solid fa-person-hiking"></i>
            <p>
                Data Pendakian
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.users.index') }}" class="nav-link">
            <i class="nav-icon fa-solid fa-user"></i>
            <p>
                Data User
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('logout') }}" class="nav-link nav-danger">
            <i class="nav-icon fa-solid fa-door-open" style="color: red;"></i>
            <p class="text-danger text-bold">
                Logout
            </p>
        </a>
    </li>
@endsection
@section('content')
    @yield('mountain-content')
@endsection
