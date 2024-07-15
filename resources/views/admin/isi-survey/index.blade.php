@extends('admin.layouts.main')

@section('content')
    <div class="section-header">
        <h1>Data Survey</h1>
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
                                        <th>Responden</th>
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
                                            <td>{{ $survey->responden->role }}</td>
                                            <td>
                                                @if ($surveyStatus[$survey->id] == 'Anda sudah mengisi')
                                                    <div class="btn btn-warning">{{ $surveyStatus[$survey->id] }}</div>
                                                @else
                                                    <a href="/admin/isi-survey/{{ $survey->id }}" type="button"
                                                        class="btn btn-success mb-1">{{ $surveyStatus[$survey->id] }}</a>
                                                @endif
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
