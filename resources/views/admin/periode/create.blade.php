@extends('admin.layouts.main')

@section('content')
    <div class="section-header">
        <h1>Tambah Data Periode</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-body">

                        <form action="/admin/periode" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="periode" class="form-label">Periode<span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="periode" id="periode"
                                    value="{{ old('periode') }}" placeholder="contoh : 2024/2025 - 1">
                                @error('periode')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="periode" class="form-label">Semester<span style="color: red">*</span></label>
                                <select name="semester" id="semester" class="form-control">
                                    <option value=""> -- Pilih Semester -- </option>
                                    <option value="gasal">Gasal</option>
                                    <option value="genap">Genap</option>
                                </select>
                                @error('periode')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <a href="/admin/periode" class="btn btn-light float-right m-1">Kembali</a>
                            <button type="submit" class="btn btn-primary float-right m-1">
                                Simpan</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
