@extends('admin.layouts.main')

@section('content')
    <div class="section-header">
        <h1>Tambah Data Survey</h1>
        <div class="ml-auto">
            <a href="/admin/survey/" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-body">
                        <form action="/admin/survey" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="nm_survey">Nama Survey</label>
                                <input type="text" name="nm_survey" id="nm_survey" class="form-control">
                                @error('nm_survey')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kategori_id">Kategori Survey</label>
                                        <select name="kategori_id" id="kategori_id" class="form-control">
                                            <option value=""> -- Pilih Kategori Survey -- </option>
                                            @foreach ($kategories as $kategori)
                                                <option value="{{ $kategori->id }}">{{ $kategori->kategori_survey }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="periode_id">Periode Survey</label>
                                        <select name="periode_id" id="periode_id" class="form-control">
                                            <option value=""> -- Pilih Periode -- </option>
                                            @foreach ($periodes as $periode)
                                                <option value="{{ $periode->id }}">{{ $periode->periode }} |
                                                    {{ $periode->semester }}</option>
                                            @endforeach
                                        </select>
                                        @error('periode_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="responden_id">Tentukan Responden</label>
                                        <select class="responden_id" id="responden_id" name="responden_id"
                                            style="width: 100%">
                                            <option value=""> -- Pilih Responden -- </option>
                                            @foreach ($respondens as $responden)
                                                <option value="{{ $responden->id }}">{{ $responden->role }}</option>
                                            @endforeach
                                        </select>
                                        @error('responden_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <hr>
                            <h4>Pertanyaan</h4>

                            <div id="pertanyaanContainer">
                                <div class="form-group row">
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary mt-4" id="addPertanyaan">Buat
                                Pertanyaan</button>
                            <button type="submit" class="btn btn-success mt-4 float-right">Simpan Survey</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            $('#responden_id').select2();
        };
    </script>

    <script>
        $(document).ready(function() {
            var jenisPertanyaan = {!! json_encode($jenisJawabans) !!};

            var counter = 1;
            $('#addPertanyaan').click(function() {
                var newDiv = $('<div>', {
                    class: 'form-group row',
                    style: 'margin-bottom: 15px;'
                });

                var newInputPertanyaan = $('<input>', {
                    type: 'text',
                    name: 'pertanyaan[]',
                    class: 'form-control col-md-6',
                    placeholder: 'Tulis pertanyaan... '
                });

                var newSelectJenisSkalaLikert = $('<select>', {
                    name: 'jenis_jawaban_id[]',
                    class: 'form-control col-md-4'
                });

                $.each(jenisPertanyaan, function(index, jenis) {
                    newSelectJenisSkalaLikert.append('<option value="' + jenis.id + '">' + jenis
                        .jenis_jawaban + '</option>');
                });

                var newButtonRemove = $('<button>', {
                    type: 'button',
                    class: 'btn btn-sm btn-danger removePertanyaan col-md-2',
                }).append($('<i>', {
                    class: 'fas fa-trash'
                }));

                newDiv.append(newInputPertanyaan);
                newDiv.append(newSelectJenisSkalaLikert);
                newDiv.append(newButtonRemove);

                $('#pertanyaanContainer').append(newDiv);
                counter++;
            });

            $(document).on('click', '.removePertanyaan', function() {
                $(this).closest('.form-group').remove();
                counter--;
            });
        });
    </script>
@endsection
