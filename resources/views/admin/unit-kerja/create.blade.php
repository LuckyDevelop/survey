@extends('admin.layouts.main')

@section('content')
    <div class="section-header">
        <h1>Tambah Data Unit Kerja</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-body">

                        <form action="/admin/unit-kerja" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md 6">
                                    <input type="hidden" name="role_id" value="4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Unit Kerja<span
                                                style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email<span
                                                style="color: red">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username<span
                                                style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="username" id="username"
                                            value="{{ old('username') }}">
                                        @error('username')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password Akun<span
                                                style="color: red">*</span></label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <a href="/admin/unit-kerja" class="btn btn-light float-right m-1">Kembali</a>
                            <button type="submit" class="btn btn-primary float-right m-1">
                                Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
