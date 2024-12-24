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
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.hikingroutes.index') }}">Data Rute
                                    Pendakian</a></li>
                            <li class="breadcrumb-item active">Form Edit Rute Pendakian</li>
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
                            <h3 class="card-title">Form Edit Rute Pendakian</h3>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputName">Nama Gunung</label>
                                            <select class="form-control" name="mountain_id" id="mountain_id">
                                                <option value="{{ $hikingroute->mountain->id }}" selected>
                                                    {{ $hikingroute->mountain->name }}
                                                </option>
                                                @foreach ($mountains as $mountain)
                                                    <option value="{{ $mountain->id }}">{{ $mountain->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName">Nama Rute</label>
                                            <input type="text" class="form-control" id="inputName" name="name"
                                                placeholder="Masukkan nama gunung" value="{{ $hikingroute->name }}"
                                                required>
                                        </div>
                                        <div class="row">
                                            <div class="col form-group">
                                                <label>Status Pendakian</label>
                                                <select class="form-control" name="status" required>
                                                    @if ($hikingroute->status == 'Buka')
                                                        <option value="Buka" selected>Buka</option>
                                                        <option value="Tutup">Tutup</option>
                                                    @else
                                                        <option value="Tutup" selected>Tutup</option>
                                                        <option value="Buka">Buka</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col form-group">
                                                <label>Tingkat Kesulitan</label>
                                                <select class="form-control" name="difficulty" required>
                                                    @if ($hikingroute->difficulty == 'Mudah')
                                                        <option value="Mudah" selected>Mudah</option>
                                                        <option value="Normal">Normal</option>
                                                        <option value="Sulit">Sulit</option>
                                                    @elseif ($hikingroute->difficulty == 'Normal')
                                                        <option value="Mudah">Mudah</option>
                                                        <option value="Normal" selected>Normal</option>
                                                        <option value="Sulit">Sulit</option>
                                                    @else
                                                        <option value="Mudah">Mudah</option>
                                                        <option value="Normal">Normal</option>
                                                        <option value="Sulit" selected>Sulit</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputLocation">Lokasi</label>
                                            <input type="text" class="form-control" id="inputLocation" name="location"
                                                placeholder="Masukkan Lokasi" value="{{ $hikingroute->location }}"
                                                required />
                                        </div>
                                        <div class="row">
                                            <div class="col form-group">
                                                <label for="inputDistance">Jarak</label>
                                                <input type="number" class="form-control" id="inputDistance"
                                                    name="distance" placeholder="Jarak Pendakian"
                                                    value="{{ $hikingroute->distance }}" required />
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputDuration">Durasi Pendakian</label>
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
                                                <label for="inputOperatingHours">Waktu Operasional</label>
                                                <input type="text" class="form-control" id="inputOperatingHours"
                                                    name="operating_hours" placeholder="Jam Operasional"
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
                                                    id="inputContact" name="contact" placeholder="Kontak"
                                                    value="{{ $hikingroute->contact }}" required>
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputFee">Biaya</label>
                                                <input type="number" step="any" class="form-control" id="inputFee"
                                                    name="fee" placeholder="Biaya" value="{{ $hikingroute->fee }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col form-group">
                                                <label for="inputFile">File</label>
                                                <input type="text" step="any" class="form-control" id="inputFile"
                                                    name="file" placeholder="File" value="{{ $hikingroute->file }}">
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputLink">Link</label>
                                                <input type="text" step="any" class="form-control" id="inputLink"
                                                    name="link" placeholder="Link" value="{{ $hikingroute->link }}">
                                            </div>
                                            {{-- @if ($hikingroute->img)
                                            @endif --}}
                                            <div class="form-group">
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
                                            <label>Peraturan</label>
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
