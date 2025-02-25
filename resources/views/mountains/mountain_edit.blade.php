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
                            <li class="breadcrumb-item"><a href="{{ route('admin.mountains.index') }}">Data Gunung</a> </li>
                            <li class="breadcrumb-item active">Form Edit Data Gunung</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.mountains.update', ['id' => $mountain->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Data Gunung</h3>
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
                                                placeholder="Masukkan nama gunung" value="{{ $mountain->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputLocation">Lokasi</label>
                                            <input type="text" class="form-control" id="inputLocation" name="location"
                                                placeholder="Masukkan Provinsi" value="{{ $mountain->location }}"
                                                required />
                                        </div>
                                        <div class="row">
                                            <div class="col form-group">
                                                <label for="inputAltitude">Ketinggian</label>
                                                <input type="number" class="form-control" id="inputAltitude"
                                                    name="altitude" placeholder="Ketinggian gunung"
                                                    value="{{ $mountain->altitude }}" required>
                                            </div>
                                            <div class="col form-group">
                                                <label>Status Gunung</label>
                                                <select class="form-control" name="status" required>
                                                    <option value="Aktif"
                                                        {{ $mountain->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                                    <option value="Tidak Aktif"
                                                        {{ $mountain->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak
                                                        Aktif</option>
                                                </select>
                                            </div>
                                            <div class="col form-group">
                                                <label>Tipe Gunung</label>
                                                <select class="form-control" name="type" required>
                                                    <option value="Maar"
                                                        {{ $mountain->type == 'Maar' ? 'selected' : '' }}>Maar</option>
                                                    <option value="Strato"
                                                        {{ $mountain->type == 'Strato' ? 'selected' : '' }}>Strato</option>
                                                    <option value="Perisai"
                                                        {{ $mountain->type == 'Perisai' ? 'selected' : '' }}>Perisai
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col form-group">
                                                <label for="inputLat">Latitude</label>
                                                <input type="number" step="any" class="form-control" id="inputLat"
                                                    name="lat" placeholder="Latitude" value="{{ $mountain->lat }}"
                                                    required>
                                            </div>
                                            <div class="col
                                                    form-group">
                                                <label for="inputLongitude">Longitude</label>
                                                <input type="number" step="any" class="form-control"
                                                    id="inputLongitude" name="lng" placeholder="Longitude"
                                                    value="{{ $mountain->lng }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputFile">File input</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputFile"
                                                        name="img" value="{{ $mountain->img }}">
                                                    <label class="custom-file-label" for="inputFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea class="form-control" rows="15" name="desc" placeholder="Masukkan deskripsi gunung ..." required>{{ $mountain->desc }}</textarea>
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
