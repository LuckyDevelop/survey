@extends('admin.layouts.main')

@section('content')
    <div class="section-header">
        <h1>Tambah Data Dosen</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-body">
                        <form action="/admin/program-studi" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="program_studi" class="form-label">Nama Program Studi <span
                                        style="color: red">*</span></label>
                                <input type="text" class="form-control" name="program_studi" id="program_studi"
                                    value="{{ old('program_studi') }}">
                                @error('program_studi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <a href="/admin/program-studi" class="btn btn-light float-right m-1">Kembali</a>
                            <button type="submit" class="btn btn-primary float-right m-1">
                                Simpan</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
