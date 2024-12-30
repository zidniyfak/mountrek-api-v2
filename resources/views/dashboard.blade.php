@extends('layout.main')
@section('title')
    <title>MountTrek | Dashboard</title>
@endsection
@section('nav-menu')
    <li class="nav-item menu-open">
        <a href="{{ route('admin.dashboard') }}" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.mountains.index') }}" class="nav-link">
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
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                {{-- Jumlah Gunung di Database --}}
                                <h3>{{ $mountain->count() }}</h3>
                                <p>Data Gunung</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-mountain-sun"></i>
                            </div>
                            <a href="{{ route('admin.mountains.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $hikingroute->count() }}</h3>
                                <p>Data Rute Pendakian</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-route"></i>
                            </div>
                            <a href="{{ route('admin.hikingroutes.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $hiking->count() }}</h3>
                                <p>Data Pendakian</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-person-hiking"></i>
                            </div>
                            <a href="{{ route('admin.hikings.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $user->count() }}</h3>
                                <p>Data User</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
