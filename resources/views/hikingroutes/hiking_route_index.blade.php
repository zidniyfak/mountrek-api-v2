@extends('hikingroutes.hiking_route_layout')
@section('hiking-route-content')
    <!-- Content Wrapper. Contains page content -->
    @yield('hikingroutes-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Rute Pendakian</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
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
                                <div class="input-group input-group-sm ml-auto" style="width: 300px;">
                                    <form action="{{ route('admin.hikingroutes.index') }}" method="GET"
                                        class="d-flex w-100">
                                        <input type="text" name="search" id="table-search-users"
                                            class="form-control float-right" placeholder="Search"
                                            value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="height: 500px;">
                                <table id="table-hiking-routes"
                                    class="table table-striped table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Rute</th>
                                            <th>Gunung</th>
                                            <th>Status</th>
                                            <th>Kesulitan</th>
                                            <th>Lokasi </th>
                                            <th>Jarak</th>
                                            <th>Durasi</th>
                                            <th>Jam Operasi</th>
                                            <th>Jumlah Pos</th>
                                            <th>Kontak</th>
                                            <th>Biaya</th>
                                            <th>Gambar</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hikingroutes as $hr)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $hr->name }}</td>
                                                <td>{{ $hr->mountain->name }}</td>
                                                <td>{{ $hr->status }}</td>
                                                <td>{{ $hr->difficulty }}</td>
                                                <td>{{ $hr->location }}</td>
                                                <td>{{ $hr->distance }}</td>
                                                <td>{{ $hr->duration }}</td>
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
                                                <td>{{ $hr->lat }}</td>
                                                <td>{{ $hr->lng }}</td>
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
                                    Rute Pendakian</a>
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
