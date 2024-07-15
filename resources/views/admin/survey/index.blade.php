@extends('admin.layouts.main')

@section('content')
    <div class="section-header">
        <h1>Data Survey</h1>
        <div class="ml-auto">
            <a href="/admin/survey/create" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah
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
                                        <th>Nama Survey</th>
                                        <th>Kategori</th>
                                        <th>Periode</th>
                                        <th>Responden</th>
                                        <th>Status</th>
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
                                                <input type="checkbox" class="switch-status" data-id="{{ $survey->id }}"
                                                    data-toggle="toggle" data-size="sm"
                                                    {{ $survey->status === 'aktif' ? 'checked' : '' }}>
                                                <span id="status-text-{{ $survey->id }}"
                                                    class="badge {{ $survey->status === 'aktif' ? 'badge-success' : 'badge-danger' }}">{{ $survey->status }}</span>
                                            </td>

                                            <td>
                                                <a href="/admin/survey/{{ $survey->id }}/edit" type="button"
                                                    class="btn btn-warning mb-1">Edit</a>
                                                <form id="{{ $survey->id }}" action="/admin/survey/{{ $survey->id }}"
                                                    method="POST" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="button" class="btn btn-danger swal-confirm mb-1"
                                                        data-form="{{ $survey->id }}">Hapus</button>
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
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.switch-status').on('change', function() {
                var surveyId = $(this).data('id');
                var status = $(this).prop('checked') ? 'aktif' : 'tidak aktif';
                var statusTextElement = $('#status-text-' + surveyId);

                // Memperbarui teks status
                statusTextElement.text(status);

                // Menghapus class yang ada dan menambahkan class badge sesuai status
                statusTextElement.removeClass('badge-success badge-danger');
                statusTextElement.addClass(status === 'aktif' ? 'badge-success' : 'badge-danger');

                // Kirim permintaan AJAX untuk menyimpan perubahan di database
                $.ajax({
                    url: '/admin/survey/' + surveyId + '/update-status',
                    type: 'PUT',
                    data: {
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Tambahkan logika atau tindakan jika update berhasil
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response if needed
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
