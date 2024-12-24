@extends('users.user_layout')
@section('user-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Users</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Data Users
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
                                            Elevasi
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
                                                hikingroutes-column="10" checked> Kontak
                                        </label>
                                        <label class="dropdown-item">
                                            <input type="checkbox" class="toggle-column-hikingroutes"
                                                hikingroutes-column="11" checked> Biaya
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
                                                hikingroutes-column="15" checked> Aturan
                                        </label>
                                    </div>
                                </div>

                                <div class="input-group input-group-sm ml-auto" style="width: 300px;">
                                    <input type="text" id="table-search-users" class="form-control float-right"
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
                                <table id="table-users"
                                    class="table table-striped table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No. Telepon</th>
                                            <th>Foto</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $u)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $u->name }}</td>
                                                <td>{{ $u->email }}</td>
                                                <td>{{ $u->phone_numb }}</td>
                                                <td>
                                                    {{-- @if ($u->img)
                                                        <img src="{{ $u->img }}" alt="{{ $u->name }}"
                                                            style="width: 100px;">
                                                    @endif --}}
                                                    <img src="{{ Storage::url('users/default.jpg') }}"
                                                        style="width: 100px;">
                                                </td>

                                                <td style="width: 100px;">
                                                    <a href="{{ route('admin.users.edit', ['id' => $u->id]) }}"
                                                        class="btn btn-warning btn-edit">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a data-toggle="modal" data-target="#modal-delete{{ $u->id }}"
                                                        class="btn btn-danger btn-delete">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="modal-delete{{ $u->id }}">
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
                                                                <b>{{ $u->name }}</b>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <form action="{{ route('admin.users.destroy', $u->id) }}"
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
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary float-right">Tambah
                                    Data Users</a>
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
