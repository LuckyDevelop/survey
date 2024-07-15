@extends('admin.layouts.main')

@section('content')
    <div class="section-header">
        <h1>Data Periode</h1>
        <div class="ml-auto">
            <a href="/admin/periode/create" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah
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
                                        <th>Periode</th>
                                        <th>Semester</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($periodes as $periode)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $periode->periode }}</td>
                                            <td>{{ $periode->semester }}</td>
                                            <td>
                                                <a href="/admin/periode/{{ $periode->id }}/edit" type="button"
                                                    class="btn btn-warning mb-1">Edit</a>
                                                <form id="{{ $periode->id }}" action="/admin/periode/{{ $periode->id }}"
                                                    method="POST" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="button" class="btn btn-danger swal-confirm mb-1"
                                                        data-form="{{ $periode->id }}">Hapus</button>
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
