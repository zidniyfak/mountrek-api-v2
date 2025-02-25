@extends('mountains.mountain_layout')

@section('mountain-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Gunung</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.mountains.index') }}">Data Gunung</a></li>
                            <li class="breadcrumb-item active">Form Tambah Data Gunung</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.mountains.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Data Gunung</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputName">Nama Gunung</label>
                                            <input type="text" class="form-control" id="inputName" name="name"
                                                placeholder="Masukkan nama gunung" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputLocation">Lokasi</label>
                                            <input type="text" class="form-control" id="inputLocation" name="location"
                                                placeholder="Masukkan Lokasi" required />
                                        </div>
                                        <div class="row">
                                            <div class="col form-group">
                                                <label for="inputAltitude">Ketinggian</label>
                                                <input type="number" class="form-control" id="inputAltitude"
                                                    name="altitude" placeholder="Ketinggian gunung" required>
                                            </div>
                                            <div class="col form-group">
                                                <label>Status Gunung</label>
                                                <select class="form-control" name="status" required>
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                                </select>
                                            </div>
                                            <div class="col form-group">
                                                <label>Tipe Gunung</label>
                                                <select class="form-control" name="type" required>
                                                    <option value="Maar">Maar</option>
                                                    <option value="Strato">Strato</option>
                                                    <option value="Perisai">Perisai</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col form-group">
                                                <label for="inputLat">Latitude</label>
                                                <input type="number" step="any" class="form-control" id="inputLat"
                                                    name="lat" placeholder="Latitude" required>
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputLongitude">Longitude</label>
                                                <input type="number" step="any" class="form-control"
                                                    id="inputLongitude" name="lng" placeholder="Longitude" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputFile">Gambar</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputFile"
                                                        name="img">
                                                    <label class="custom-file-label" for="inputFile">Pilih Gambar
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea class="form-control" rows="15" name="desc" placeholder="Masukkan deskripsi gunung ..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                        <!-- /.form-end -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
