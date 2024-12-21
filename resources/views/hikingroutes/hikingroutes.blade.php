@extends('layout.main')
@section('title')
    <title>MountTrek | Mountains Data</title>
@endsection
@section('nav-menu')
    <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.mountains.index') }}" class="nav-link ">
            <i class="nav-icon fa-solid fa-mountain"></i>
            <p>
                Gunung
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.hikingroutes.index') }}" class="nav-link active">
            <i class="nav-icon fa-solid fa-route"></i>
            <p>
                Rute Pendakian
            </p>
        </a>
    </li>
    <li class="nav-item nav-danger">
        <a href="{{ route('logout') }}" class="nav-link">
            <i class="nav-icon fa-solid fa-door-open"></i>
            <p>
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
                        <h1 class="m-0">Rute Pendakian</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Rute Pendakian
                            </li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-title dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Toggle Columns
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column-hikingroutes"
                                                hikingroutes-column="1" checked> Nama
                                            Rute
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column-hikingroutes"
                                                hikingroutes-column="2" checked>
                                            Status
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column-hikingroutes"
                                                hikingroutes-column="3" checked>
                                            Kesulitan
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column-hikingroutes"
                                                hikingroutes-column="4" checked> Lokasi
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column-hikingroutes"
                                                hikingroutes-column="5" checked> Jarak
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column-hikingroutes"
                                                hikingroutes-column="6" checked>
                                            Durasi
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column-hikingroutes"
                                                hikingroutes-column="7" checked>
                                            Elevation Gain
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column-hikingroutes"
                                                hikingroutes-column="8" checked>
                                            Jam Operasional
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column-hikingroutes"
                                                hikingroutes-column="9" checked> Jumlah Pos
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column-hikingroutes"
                                                hikingroutes-column="10" checked> Contact
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column-hikingroutes"
                                                hikingroutes-column="11" checked> Fee
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column-hikingroutes"
                                                hikingroutes-column="12" checked> Img
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column-hikingroutes"
                                                hikingroutes-column="13" checked> File
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column-hikingroutes"
                                                hikingroutes-column="14" checked> Link
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column-hikingroutes"
                                                hikingroutes-column="15" checked> Rules
                                        </label>
                                    </div>
                                </div>

                                <div class="input-group input-group-sm ml-auto" style="width: 300px;">
                                    <input type="text" id="table-search-hikingroutes" class="form-control float-right"
                                        placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="height: 500px;">
                                <table id="table-hikingroutes"
                                    class="table table-striped table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Rute</th>
                                            <th>Status</th>
                                            <th>Kesulitan</th>
                                            <th>Lokasi </th>
                                            <th>Jarak</th>
                                            <th>Durasi</th>
                                            <th>Elevation Gain</th>
                                            <th>Jam Operasi</th>
                                            <th>Jumlah Pos</th>
                                            <th>Kontak</th>
                                            <th>Biaya</th>
                                            <th>Img</th>
                                            <th>File</th>
                                            <th>Link</th>
                                            <th>Rules</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hikingroutes as $hr)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $hr->name }}</td>
                                                <td>{{ $hr->status }}</td>
                                                <td>{{ $hr->difficulty }}</td>
                                                <td>{{ $hr->location }}</td>
                                                <td>{{ $hr->distance }}</td>
                                                <td>{{ $hr->duration }}</td>
                                                <td>{{ $hr->elevation_gain }}</td>
                                                <td>{{ $hr->operating_hours }}</td>
                                                <td>{{ $hr->numb_of_posts }}</td>
                                                <td>{{ $hr->contact }}</td>
                                                <td>{{ $hr->fee }}</td>
                                                <td style="width: 100px; ">
                                                    @if ($hr->img)
                                                        <img src="{{ $hr->img }}" alt="{{ $hr->name }}"
                                                            style="width: 100px;">
                                                    @endif
                                                </td>
                                                {{-- <td>{{ $hr->img }}</td> --}}
                                                <td>{{ $hr->file }}</td>
                                                <td>{{ $hr->link }}</td>
                                                <td>{{ $hr->rules }}</td>
                                                <td style="width: 100px;">
                                                    <a href="{{ route('admin.hikingroutes.edit', ['id' => $hr->id]) }}"
                                                        class="btn btn-warning btn-edit">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a data-toggle="modal" data-target="#modal-delete{{ $hr->id }}"
                                                        class="btn btn-danger btn-delete">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="modal-delete{{ $hr->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah kamu yakin untuk menghapus data
                                                                <b>{{ $hr->name }}</b>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">


                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <form
                                                                action="{{ route('admin.hikingroutes.destroy', $hr->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Hapus
                                                                    data</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <a href="{{ route('admin.hikingroutes.create') }}"
                                    class="btn btn-primary float-right">Tambah
                                    Data
                                    Rute</a>
                            </div>
                        </div>
                        <!-- /.card -->

                    </div>
                </div>
                <!-- /.row (main row) -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
