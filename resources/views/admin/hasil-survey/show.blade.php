@extends('admin.layouts.main')

@section('content')
    <div class="section-header">
        <h1>Responden</h1>
        <div class="ml-auto">
            <a href="/admin/hasil-survey" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
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
                            @if ($respondens->isEmpty())
                                <p>Belum ada responden yang mengisi survey.</p>
                            @else
                                <table id="respondensTable"
                                    class="table table-bordered table-hover table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Mengisi Pada</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($respondens as $responden)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $responden->name }}</td>
                                                <td>{{ $responden->role->role }}</td>
                                                <td>{{ $responden->created_at->format('d M Y, H:i') }}</td>
                                                <td>
                                                    <a href="/admin/hasil-survey/survey-responden/{{ $responden->id }}/{{ $survey->id }}"
                                                        class="btn btn-success">Hasil Survey</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Datatables Jquery -->
    <script>
        $(document).ready(function() {
            $('#respondensTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json"
                },
                "order": [
                    [3, "desc"]
                ],
                "columnDefs": [{
                    "orderable": false,
                    "targets": [0, 4]
                }]
            });
        });
    </script>
@endsection
