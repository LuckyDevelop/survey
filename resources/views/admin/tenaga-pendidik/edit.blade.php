@extends('admin.layouts.main')

@section('content')
    <div class="section-header">
        <h1>Edit Data Tenaga Pendidik</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-body">
                        <form action="/admin/tenaga-pendidik/{{ $tenaga_pendidik->id }}" method="POST">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="col-md 6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap<span
                                                style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ old('name', $tenaga_pendidik->name) }}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_induk" class="form-label">Nomor Induk Pegawai (NIP)<span
                                                style="color: red">*</span></label>
                                        <input type="number" class="form-control" name="no_induk" id="no_induk"
                                            value="{{ old('no_induk', $tenaga_pendidik->no_induk) }}">
                                        @error('no_induk')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="status_pegawai" class="form-label">Status Pegawai<span
                                                style="color: red">*</span></label>
                                        <select class="form-control" name="status_pegawai" id="status_pegawai"
                                            onchange="toggleStatusPegawaiLainnya()">
                                            <option value="">-- Pilih Status Pegawai --</option>
                                            <option value="PNS"
                                                {{ old('status_pegawai', $tenaga_pendidik->status_pegawai ?? '') == 'PNS' ? 'selected' : '' }}>
                                                PNS</option>
                                            <option value="PPNPN"
                                                {{ old('status_pegawai', $tenaga_pendidik->status_pegawai ?? '') == 'PPNPN' ? 'selected' : '' }}>
                                                PPNPN</option>
                                            <option value="Lainnya"
                                                {{ old('status_pegawai', $tenaga_pendidik->status_pegawai ?? '') != 'PNS' && old('status_pegawai', $tenaga_pendidik->status_pegawai ?? '') != 'PPNPN' ? 'selected' : '' }}>
                                                Lainnya</option>
                                        </select>
                                        @error('status_pegawai')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="text" class="form-control mt-3" name="status_pegawai_lainnya"
                                            id="status_pegawai_lainnya"
                                            value="{{ old('status_pegawai_lainnya', $tenaga_pendidik->status_pegawai ?? '') }}"
                                            style="display: {{ old('status_pegawai', $tenaga_pendidik->status_pegawai ?? '') != 'PNS' && old('status_pegawai', $tenaga_pendidik->status_pegawai ?? '') != 'PPNPN' ? 'block' : 'none' }};">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email<span
                                                style="color: red">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            value="{{ old('email', $tenaga_pendidik->email) }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="jabatan" class="form-label">Status Jabatan<span
                                                style="color: red">*</span></label>
                                        <select class="form-control" name="jabatan" id="jabatan">
                                            <option value="">-- Pilih Status Jabatan --</option>
                                            <option value="Fungsional Umum"
                                                {{ old('jabatan', $tenaga_pendidik->jabatan) == 'Fungsional Umum' ? 'selected' : '' }}>
                                                Fungsional Umum</option>
                                            <option value="Fungsional Teknis/Tertentu"
                                                {{ old('jabatan', $tenaga_pendidik->jabatan) == 'Fungsional Teknis/Tertentu' ? 'selected' : '' }}>
                                                Fungsional Teknis/Tertentu</option>
                                        </select>
                                        @error('jabatan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <a href="/admin/tenaga-pendidik" class="btn btn-light float-right m-1">Kembali</a>
                            <button type="submit" class="btn btn-primary float-right m-1">
                                Update</button>
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
</script>
