@extends('admin.layouts.main')

@section('content')
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-3">
                <div class="card card-primary">
                    <div class="card-header">
                        Total Survey
                    </div>
                    <div class="card-body">
                        {{ $totalSurvey }} Survey
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-success">
                    <div class="card-header">
                        Jumlah Program Studi
                    </div>
                    <div class="card-body">
                        {{ $totalProdi }} Prodi
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-warning">
                    <div class="card-header">
                        Jumlah Dosen
                    </div>
                    <div class="card-body">
                        {{ $jumlahDosen }} Dosen
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-danger">
                    <div class="card-header">
                        Jumlah Mahasiswa
                    </div>
                    <div class="card-body">
                        {{ $jumlahMhs }} Mahasiswa
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-header">
                        Data Survey Terbaru
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table_id"
                                    class="table table-bordered table-hover table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Survey</th>
                                            <th>Kategori</th>
                                            <th>Periode</th>
                                            <th>Responden</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (auth()->user()->role_id == '1')
                                            @foreach ($allSurvey as $survey)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $survey->nm_survey ?? '-' }}</td>
                                                    <td>{{ $survey->kategori->kategori_survey ?? '-' }}</td>
                                                    <td>{{ $survey->periode->periode ?? '-' }}</td>
                                                    <td>{{ $survey->responden->role ?? '-' }}</td>
                                                    <td>
                                                        @if ($survey->status == 'aktif')
                                                            <div class="badge badge-success">{{ $survey->status }}</div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            @foreach ($userSurvey as $survey)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $survey->nm_survey }}</td>
                                                    <td>{{ $survey->kategori->kategori_survey }}</td>
                                                    <td>{{ $survey->periode->periode }}</td>
                                                    <td>{{ $survey->responden->role }}</td>
                                                    <td>
                                                        @if ($survey->status == 'aktif')
                                                            <div class="badge badge-success">{{ $survey->status }}</div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
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
