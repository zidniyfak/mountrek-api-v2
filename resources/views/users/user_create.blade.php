@extends('users.user_layout')

@section('user-content')
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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">General Form</li>
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
                            <h3 class="card-title">Tambah Data Rute Pendakian</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputName">ID Gunung</label>
                                            <input type="number" class="form-control" id="inputName" name="mountain_id"
                                                placeholder="Masukkan id Gunung" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName">Nama Rute</label>
                                            <input type="text" class="form-control" id="inputName" name="name"
                                                placeholder="Masukkan nama gunung" required>
                                        </div>
                                        <div class="row">
                                            <div class="col form-group">
                                                <label>Status Pendakian</label>
                                                <select class="form-control" name="status" required>
                                                    <option value="Buka">Buka</option>
                                                    <option value="Tutup">Tutup</option>
                                                </select>
                                            </div>
                                            <div class="col form-group">
                                                <label>Kesulitan</label>
                                                <select class="form-control" name="difficulty" required>
                                                    <option value="Buka">Mudah</option>
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
                                            <div class="form-group">
                                                <label for="inputDistance">Jarak</label>
                                                <input type="number" class="form-control" id="inputDistance"
                                                    name="distance" placeholder="Jarak Pendakian" required />
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputDuration">Durasi</label>
                                                <input type="number" class="form-control" id="inputDuration"
                                                    name="duration" placeholder="Durasi Pendakian" required>
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputElevasi">Elevasi</label>
                                                <input type="number" class="form-control" id="inputElevasi"
                                                    name="elevation_gain" placeholder="Elevasi" required>
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputOperatingHours">Jam Operasi</label>
                                                <input type="number" class="form-control" id="inputOperatingHours"
                                                    name="operating_hours" placeholder="Ketinggian gunung" required>
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
                                                <input type="text" step="any" class="form-control" id="inputContact"
                                                    name="contact" placeholder="Latitude" required>
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputFee">Biaya</label>
                                                <input type="number" step="any" class="form-control" id="inputFee"
                                                    name="fee" placeholder="Longitude" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputImage">Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputImage"
                                                        name="img">
                                                    <label class="custom-file-label" for="inputFile">Choose
                                                        Image</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col form-group">
                                                <label for="inputFile">File</label>
                                                <input type="text" step="any" class="form-control" id="inputFile"
                                                    name="file" placeholder="File" required>
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputLink">Link</label>
                                                <input type="text" step="any" class="form-control" id="inputLink"
                                                    name="link" placeholder="Link" required>
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
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
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
