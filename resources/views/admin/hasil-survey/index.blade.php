@extends('admin.layouts.main')

@section('content')
    <div class="section-header">
        <h1>Data Hasil Survey</h1>
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
                                        <th>Nama Survey</th>
                                        <th>Kategori</th>
                                        <th>Periode</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($surveys as $survey)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $survey->nm_survey }}</td>
                                            <td>{{ $survey->kategori->kategori_survey }}</td>
                                            <td>{{ $survey->periode->periode }}</td>
                                            <td>
                                                <a href="/admin/hasil-survey/{{ $survey->id }}" type="button"
                                                    class="btn btn-success mb-1">Lihat Reponden</a>
                                                <a href="/admin/hasil-survey/rekap-survey/{{ $survey->id }}"
                                                    class="btn btn-danger mb-1">Rekap Survey</a>
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
        });
    </script>
@endsection
