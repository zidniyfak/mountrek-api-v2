@extends('hikingroutes.hiking_route_layout')
@section('hiking-route-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Rute Pendakian</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.hikingroutes.index') }}">Data Rute
                                    Pendakian</a></li>
                            <li class="breadcrumb-item active">Form Tambah Rute Pendakian</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.hikingroutes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Rute Pendakian</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col form-group">
                                                <label for="inputMountainId">Nama Gunung</label>
                                                <select id="inputMountainId" name="mountain_id" class="form-control">
                                                    <option selected disabled>Pilih Gunung</option>
                                                    @foreach ($mountains as $mountain)
                                                        <option value="{{ $mountain->id }}">{{ $mountain->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputName">Nama Rute</label>
                                                <input type="text" class="form-control" id="inputName" name="name"
                                                    placeholder="Masukkan nama rute" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col form-group">
                                                <label>Status Pendakian</label>
                                                <select class="form-control" name="status" required>
                                                    <option selected disabled>Pilih Status Pendakian</option>
                                                    <option value="Buka">Buka</option>
                                                    <option value="Tutup">Tutup</option>
                                                </select>
                                            </div>
                                            <div class="col form-group">
                                                <label>Tingkat Kesulitan</label>
                                                <select class="form-control" name="difficulty" required>
                                                    <option selected disabled>Pilih Tingkat Kesulitan</option>
                                                    <option value="Mudah">Mudah</option>
                                                    <option value="Normal">Normal</option>
                                                    <option value="Sulit">Sulit</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputLocation">Lokasi</label>
                                            <input type="text" class="form-control" id="inputLocation" name="location"
                                                placeholder="Masukkan Lokasi" required />
                                        </div>
                                        <div class="row">
                                            <div class="col form-group">
                                                <label for="inputDistance">Jarak</label>
                                                <input type="number" class="form-control" id="inputDistance"
                                                    name="distance" placeholder="Jarak Pendakian" required />
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputDuration">Durasi Pendakian</label>
                                                <input type="number" class="form-control" id="inputDuration"
                                                    name="duration" placeholder="Durasi Pendakian" required>
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputOperatingHours">Waktu Operasional</label>
                                                <input type="text" class="form-control" id="inputOperatingHours"
                                                    name="operating_hours" placeholder="Jam Operasional" required>
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
                                        <div class="row">
                                            <div class="col form-group">
                                                <label for="inputPos">Jumlah Pos</label>
                                                <input type="number" step="any" class="form-control" id="inputPos"
                                                    name="numb_of_posts" placeholder="Jumlah Pos" required>
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputContact">Kontak</label>
                                                <input type="text" step="any" class="form-control"
                                                    id="inputContact" name="contact" placeholder="Kontak" required>
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputFee">Biaya</label>
                                                <input type="number" step="any" class="form-control" id="inputFee"
                                                    name="fee" placeholder="Biaya" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col form-group">
                                                <label for="inputFile">File</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="inputFile"
                                                            name="file">
                                                        <label class="custom-file-label" for="inputFile">Pilih
                                                            File</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputImage">Gambar</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="inputImage"
                                                            name="img">
                                                        <label class="custom-file-label" for="inputFile">Pilih
                                                            Gambar</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Rules</label>
                                            <textarea class="form-control" rows="15" name="rules" placeholder="Masukkan deskripsi gunung ..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                        <!-- /.form-end -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Simpan Data</button>
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
