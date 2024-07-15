@extends('admin.layouts.main')

@section('content')
    <div class="section-header">
        <h1>Edit Data Dosen</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-body">
                        <form action="/admin/dosen/{{ $dosen->id }}" method="POST">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="col-md 6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap<span
                                                style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ old('name', $dosen->name) }}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_induk" class="form-label">Nomor Induk Dosen (NIDN)<span
                                                style="color: red">*</span></label>
                                        <input type="number" class="form-control" name="no_induk" id="no_induk"
                                            value="{{ old('no_induk', $dosen->no_induk) }}">
                                        @error('no_induk')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="prodi_id" class="form-label">Program Studi<span
                                                style="color: red">*</span></label>
                                        <select class="form-control" name="prodi_id" id="prodi_id">
                                            @foreach ($prodies as $prodi)
                                                <option value="{{ $prodi->id }}"
                                                    @if ($dosen->prodi_id == $prodi->id) selected @endif>
                                                    {{ $prodi->program_studi }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email<span
                                                style="color: red">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            value="{{ old('email', $dosen->email) }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <a href="/admin/dosen" class="btn btn-light float-right m-1">Kembali</a>
                            <button type="submit" class="btn btn-primary float-right m-1">
                                Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
