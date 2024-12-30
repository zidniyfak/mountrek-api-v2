@extends('users.user_layout')

@section('user-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Data User</a></li>
                            <li class="breadcrumb-item active">From Tambah Data User</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Tambah User</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inputName">Nama</label>
                                                <input type="text" class="form-control" id="inputName" name="name"
                                                    placeholder="Masukkan nama">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail">Email</label>
                                                <input type="email" class="form-control" id="inputEmail" name="email"
                                                    placeholder="Masukkan email">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPhone">Nomor Telepon</label>
                                                <input type="text" class="form-control" id="inputPhone" name="phone_numb"
                                                    placeholder="Masukkan No. telepon" />
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPassword">Password</label>
                                                <input type="password" class="form-control" id="inputPassword"
                                                    name="password" placeholder="Masukkan Password" />
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
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                            <!-- /.form-end -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
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
