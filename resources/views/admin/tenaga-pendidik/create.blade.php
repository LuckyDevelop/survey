@extends('admin.layouts.main')

@section('content')
    <div class="section-header">
        <h1>Tambah Data Tenaga Pendidik</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-body">
                        <form action="/admin/tenaga-pendidik" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md 6">
                                    <input type="hidden" name="role_id" value="5">
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
                                        <label for="no_induk" class="form-label">Nomor Induk Pegawai (NIP)<span
                                                style="color: red">*</span></label>
                                        <input type="number" class="form-control" name="no_induk" id="no_induk"
                                            value="{{ old('no_induk') }}">
                                        @error('no_induk')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="status_pegawai" class="form-label">Status Jabatan<span
                                                style="color: red">*</span></label>
                                        <select class="form-control" name="status_pegawai" id="status_pegawai"
                                            onchange="toggleStatusPegawaiLainnya()">
                                            <option value="">-- Pilih Status Jabatan --</option>
                                            <option value="PNS" {{ old('status_pegawai') == 'PNS' ? 'selected' : '' }}>
                                                PNS</option>
                                            <option value="PPNPN" {{ old('status_pegawai') == 'PPNPN' ? 'selected' : '' }}>
                                                PPNPN</option>
                                            <option value="Lainnya"
                                                {{ old('status_pegawai') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('status_pegawai')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="text" class="form-control mt-3" name="status_pegawai_lainnya"
                                            id="status_pegawai_lainnya" value="{{ old('status_pegawai_lainnya') }}"
                                            style="display: {{ old('status_pegawai') == 'Lainnya' ? 'block' : 'none' }};">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email<span
                                                style="color: red">*</span></label>
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
                                    <div class="mb-3">
                                        <label for="jabatan" class="form-label">Status Jabatan<span
                                                style="color: red">*</span></label>
                                        <select class="form-control" name="jabatan" id="jabatan">
                                            <option value="">-- Pilih Status Jabatan --</option>
                                            <option value="Fungsional Umum" {{ old('jabatan') }}>Fungsional Umum</option>
                                            <option value="Fungsional Teknis/Tertentu" {{ old('jabatan') }}>Fungsional
                                                Teknis/Tertentu</option>
                                        </select>
                                        @error('jabatan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <a href="/admin/tenaga-pendidik" class="btn btn-light float-right m-1">Kembali</a>
                            <button type="submit" class="btn btn-primary float-right m-1">
                                Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function toggleStatusPegawaiLainnya() {
        var statusPegawai = document.getElementById('status_pegawai').value;
        var statusPegawaiLainnya = document.getElementById('status_pegawai_lainnya');
        if (statusPegawai === 'Lainnya') {
            statusPegawaiLainnya.style.display = 'block';
        } else {
            statusPegawaiLainnya.style.display = 'none';
            statusPegawaiLainnya.value = '';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        toggleStatusPegawaiLainnya();
    });
</script>
