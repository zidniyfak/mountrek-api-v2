@extends('mountains.mountain_layout')
@section('mountain-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Gunung</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Data Gunung
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
                                            <input type="checkbox" class="toggle-column" data-column="1" checked>
                                            Gunung
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column" data-column="2" checked>
                                            Rute
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column" data-column="3" checked>
                                            Lokasi
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column" data-column="4" checked>
                                            Ketinggian
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column" data-column="5" checked> Status
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column" data-column="6" checked> Tipe
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column" data-column="7" checked>
                                            Latitude
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column" data-column="8" checked>
                                            Longitude
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column" data-column="9" checked>
                                            Deskripsi
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column" data-column="10" checked> Gambar
                                        </label>
                                    </div>
                                </div>

                                <div class="input-group input-group-sm ml-auto" style="width: 300px;">
                                    <form action="{{ route('admin.mountains.index') }}" method="GET" class="d-flex w-100">
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
                                <table id="table-mountains"
                                    class="table table-striped table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Gunung</th>
                                            <th>Rute</th>
                                            <th>Lokasi</th>
                                            <th>Ketinggian</th>
                                            <th>Status </th>
                                            <th>Tipe</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th>Deskripsi</th>
                                            <th>Gambar</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mountains as $m)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-left">{{ $m->name }}</td>
                                                <td class="text-left">
                                                    @foreach ($m->hiking_route as $hr)
                                                        - {{ $hr->name }}<br>
                                                    @endforeach
                                                </td>
                                                <td class="text-left">{{ $m->location }}</td>
                                                <td>{{ $m->altitude }}</td>
                                                <td>{{ $m->status }}</td>
                                                <td>{{ $m->type }}</td>
                                                <td>{{ $m->lat }}</td>
                                                <td>{{ $m->lng }}</td>
                                                <td class="text-start"
                                                    style="max-width: 300px; overflow: hidden; text-overflow: ellipsis;">
                                                    {{ $m->desc }}
                                                </td>
                                                <td style="width: 100px; ">
                                                    @if ($m->img)
                                                        <img src="{{ $m->img }}" alt="{{ $m->name }}"
                                                            style="width: 100px;">
                                                    @endif
                                                </td>
                                                <td style="width: 100px;">
                                                    <a href="{{ route('admin.mountains.edit', ['id' => $m->id]) }}"
                                                        class="btn btn-warning btn-edit">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a data-toggle="modal" data-target="#modal-delete{{ $m->id }}"
                                                        class="btn btn-danger btn-delete">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="modal-delete{{ $m->id }}">
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
                                                                <b>{{ $m->name }}</b>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">


                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <form action="{{ route('admin.mountains.destroy', $m->id) }}"
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
                                <a href="{{ route('admin.mountains.create') }}"
                                    class="btn btn-primary float-right">Tambah
                                    Data
                                    Gunung</a>
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
