@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-header">
                    <h5 class="card-title fw-semibold">Tambah Data Dosen</h5>
                </div>

                <div class="card-body">
                    <form action="/admin/dosen" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md 6">
                                <input type="hidden" name="role_id" value="2">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap<span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="no_induk" class="form-label">Nomor Induk Dosen (NIDN)<span
                                            style="color: red">*</span></label>
                                    <input type="number" class="form-control" name="no_induk" id="no_induk"
                                        value="{{ old('no_induk') }}">
                                    @error('no_induk')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="prodi_id" class="form-label">Program Studi<span
                                            style="color: red">*</span></label>
                                    <select class="form-control" name="prodi_id" id="prodi_id">
                                        <option value="">-- Pilih Program Studi --</option>
                                        @foreach ($programStudies as $prodi)
                                            <option value="{{ $prodi->id }}">{{ $prodi->program_studi }}</option>
                                        @endforeach
                                    </select>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email<span style="color: red">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="{{ old('email') }}">
                                    @error('email')
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


                        <a href="/admin/dosen" class="btn btn-light float-end">Kembali</a>
                        <button type="submit" class="btn btn-primary float-end me-2">
                            Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
@endsection
