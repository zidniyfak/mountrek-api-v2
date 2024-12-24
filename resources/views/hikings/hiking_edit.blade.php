@extends('hikings.hiking_layout')

@section('hiking-content')
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.hikings.index') }}">Data Pendakian</a></li>
                            <li class="breadcrumb-item active">Form Edit Data Pendakian</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.hikings.update', ['id' => $hiking->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Update Data Rute Pendakian</h3>
                        </div>
                        <!-- /.card-header -->
                        {{-- @foreach ($mountains as $m)
                                                    <option value="{{ $m->id }}">
                                                        {{ $m->name }}
                                                    </option>
                                                @endforeach --}}
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputName">Nama Pendaki</label>
                                            <input type="text" class="form-control" id="inputName"
                                                name="mountain_id"value="{{ $hiking->user->name }} " disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Gunung</label>
                                            <select class="form-control select2" name="gunung" style="width: 100%;">
                                                <option value="">Gunung Merbabu</option>
                                                <option value="">Gunung Andong</option>
                                                <option value="">Gunung Sumbing</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Gunung</label>
                                            <select class="form-control select2" name="difficulty" style="width: 100%;">
                                                <option value="">Gunung Merbabu</option>
                                                <option value="">Gunung Andong</option>
                                                <option value="">Gunung Sumbing</option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col form-group">
                                                <label>Tanggal Naik</label>
                                                <div class="input-group date" id="tanggalnaik" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input"
                                                        data-target="#tanggalnaik" />
                                                    <div class="input-group-append" data-target="#tanggalnaik"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col form-group">
                                                <label>Tanggal Turun</label>
                                                <div class="input-group date" id="tanggalturun" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input"
                                                        data-target="#tanggalturun" />
                                                    <div class="input-group-append" data-target="#tanggalturun"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col form-group">
                                                <label for="inputDuration">Durasi</label>
                                                <input type="number" class="form-control" id="inputDuration"
                                                    name="duration" placeholder="Durasi Pendakian" value="" required>
                                            </div>
                                            <div class="col form-group">
                                                <label for="inputDistance">Jumlah Anggota</label>
                                                <input type="number" class="form-control" id="inputDistance"
                                                    name="distance" placeholder="Jarak Pendakian" required value="">
                                            </div>
                                        </div>
                                        <div class="col form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="difficulty" required>
                                                <option value="Buka">Active</option>
                                                <option value="Normal">Scheduled</option>
                                                <option value="Sulit">Sulit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Catatan</label>
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
