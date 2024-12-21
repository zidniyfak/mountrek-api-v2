@extends('layout.main')
@section('title')
    <title>MountTrek | Mountains Data</title>
@endsection
@section('nav-menu')
    <li class="nav-item menu-open">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.mountains.index') }}" class="nav-link active">
            <i class="nav-icon fa-solid fa-mountain"></i>
            <p>
                Gunung
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('admin/hikingroutes') }}" class="nav-link">
            <i class="nav-icon fa-solid fa-route"></i>
            <p>
                Rute Pendakian

                {{-- <span class="badge badge-info right">6</span> --}}
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('logout') }}" class="nav-link">
            <i class="nav-icon fa-solid fa-route"></i>
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
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Rute Pendakian</h1>
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
                <form action="{{ route('admin.hikingroutes.update', ['id' => $hikingroute->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Update Data Rute Pendakian</h3>
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
                                                placeholder="Masukkan id Gunung" value="{{ $hikingroute->mountain_id }}"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName">Nama Rute</label>
                                            <input type="text" class="form-control" id="inputName" name="name"
                                                placeholder="Masukkan nama gunung" required
                                                value="{{ $hikingroute->name }}">
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
                                                    <option value="Mudah">Mudah</option>
                                                    <option value="Normal">Normal</option>
                                                    <option value="Sulit">Sulit</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputLocation">Lokasi</label>
                                            <input type="text" class="form-control" id="inputLocation" name="location"
                                                placeholder="Masukkan Lokasi" required value="{{ $hikingroute->location }}">

                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="inputDistance">Jarak</label>
                                                <input type="number" class="form-control" id="inputDistance"
                                                    name="distance" placeholder="Jarak Pendakian" required
                                                    value="{{ $hikingroute->distance }}">
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputDuration">Durasi</label>
                                                <input type="number" class="form-control" id="inputDuration"
                                                    name="duration" placeholder="Durasi Pendakian"
                                                    value="{{ $hikingroute->duration }}" required>
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputElevasi">Elevasi</label>
                                                <input type="number" class="form-control" id="inputElevasi"
                                                    name="elevation_gain" placeholder="Elevasi"
                                                    value="{{ $hikingroute->elevation_gain }}" required>
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputOperatingHours">Jam Operasi</label>
                                                <input type="number" class="form-control" id="inputOperatingHours"
                                                    name="operating_hours" placeholder="Ketinggian gunung"
                                                    value="{{ $hikingroute->operating_hours }}" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col form-group">
                                                <label for="inputPos">Jumlah Pos</label>
                                                <input type="number" step="any" class="form-control" id="inputPos"
                                                    name="numb_of_posts" placeholder="Jumlah Pos"
                                                    value="{{ $hikingroute->numb_of_posts }}" required>
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputContact">Kontak</label>
                                                <input type="text" step="any" class="form-control"
                                                    id="inputContact" name="contact" placeholder="Latitude" required
                                                    value="{{ $hikingroute->contact }}">
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputFee">Biaya</label>
                                                <input type="number" step="any" class="form-control" id="inputFee"
                                                    name="fee" placeholder="Longitude" required
                                                    value="{{ $hikingroute->fee }}">
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
                                                    name="file" placeholder="File" required
                                                    value="{{ $hikingroute->file }}">
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputLink">Link</label>
                                                <input type="text" step="any" class="form-control" id="inputLink"
                                                    name="link" placeholder="Link" required
                                                    value="{{ $hikingroute->link }}">
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
