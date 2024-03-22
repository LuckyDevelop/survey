@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title fw-semibold">Data Dosen</h5>
                        </div>
                        <div class="col-6 text-right">
                            <a href="/admin/dosen/create" type="button" class="btn btn-primary float-end">Tambah
                                Data</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="table-responsive">
                            <table id="table_id" class="table display">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIDN</th>
                                        <th>Email</th>
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
                                            <td>{{ $dosen->email }}</td>
                                            <td>{{ $dosen->prodi->program_studi }}</td>
                                            <td>
                                                <a href="/admin/dosen/{{ $dosen->id }}/edit" type="button"
                                                    class="btn btn-warning mb-1"><i class="ti ti-edit"></i></a>
                                                <form id="{{ $dosen->id }}" action="/admin/dosen/{{ $dosen->id }}"
                                                    method="POST" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="button" class="btn btn-danger swal-confirm mb-1"
                                                        data-form="{{ $dosen->id }}"><i class="ti ti-trash"></i></button>
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

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
@endsection
