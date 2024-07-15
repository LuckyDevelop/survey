@extends('admin.layouts.main')

@section('content')
    <div class="section-header">
        <h1>Data Dosen</h1>
        <div class="ml-auto">
            <a href="/admin/dosen/create" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah
                Data</a>
        </div>
    </div>

    <div class="section-body">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table_id" class="table table-bordered table-hover table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIDN</th>
                                        <th>Program Studi</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dosens as $dosen)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dosen->name }}</td>
                                            <td>{{ $dosen->no_induk }}</td>
                                            <td>{{ $dosen->prodi->program_studi }}</td>
                                            <td>
                                                <a href="/admin/dosen/{{ $dosen->id }}/edit" type="button"
                                                    class="btn btn-warning mb-1">Edit</a>
                                                <form id="{{ $dosen->id }}" action="/admin/dosen/{{ $dosen->id }}"
                                                    method="POST" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="button" class="btn btn-danger swal-confirm mb-1"
                                                        data-form="{{ $dosen->id }}">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Datatables Jquery -->
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        })
    </script>
@endsection
