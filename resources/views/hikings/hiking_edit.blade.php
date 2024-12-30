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
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Form Update Data Pendakian</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="user_id">Nama Pendaki</label>
                                    <select class="form-control select2" id="user_id" name="user_id" required readonly>
                                        <option value="{{ $hiking->user_id }}" selected>{{ $hiking->user->name }}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="mountain_id">Gunung</label>
                                    <select class="form-control select2" id="mountain_id" name="mountain_id" required>
                                        <option value="" disabled>Pilih Gunung</option>
                                        @foreach ($mountains as $mountain)
                                            <option value="{{ $mountain->id }}"
                                                {{ $hiking->hiking_route->mountain_id == $mountain->id ? 'selected' : '' }}>
                                                {{ $mountain->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="hiking_route_id">Rute Pendakian</label>
                                    <select class="form-control select2" id="hiking_route_id" name="hiking_route_id"
                                        required>
                                        <option value="{{ $hiking->hiking_route_id }}" selected>
                                            {{ $hiking->hiking_route->name }}
                                        </option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col form-group">
                                        <label>Tanggal Naik</label>
                                        <div class="input-group date" id="tanggalnaik" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"
                                                data-target="#tanggalnaik" name="start_date"
                                                value="{{ $hiking->start_date }}" />
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
                                                data-target="#tanggalturun" name="end_date"
                                                value="{{ $hiking->end_date }}" />
                                            <div class="input-group-append" data-target="#tanggalturun"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="numb_of_teams">Jumlah Tim</label>
                                    <input type="number" class="form-control" id="numb_of_teams" name="numb_of_teams"
                                        value="{{ $hiking->numb_of_teams }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="notes">Deskripsi</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3">{{ $hiking->notes }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status Pendakian</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="scheduled" {{ $hiking->status == 'scheduled' ? 'selected' : '' }}>
                                            Scheduled</option>
                                        <option value="active" {{ $hiking->status == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="finished" {{ $hiking->status == 'finished' ? 'selected' : '' }}>
                                            Finished</option>
                                        <option value="cancelled" {{ $hiking->status == 'cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
