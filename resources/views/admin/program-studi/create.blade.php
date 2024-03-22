@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-header">
                    <h5 class="card-title fw-semibold">Tambah Program Studi</h5>
                </div>

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
                        <a href="/admin/program-studi" class="btn btn-light float-end">Kembali</a>
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
