@extends('admin.layouts.main')

@section('content')
    <div class="section-header">
        <h1>Edit Data Survey</h1>
        <div class="ml-auto">
            <a href="/admin/survey/" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-body">
                        <form action="/admin/survey/{{ $survey->id }}" method="POST">
                            @method('put')
                            @csrf

                            <div class="form-group">
                                <label for="nm_survey">Nama Survey</label>
                                <input type="text" name="nm_survey" id="nm_survey" value="{{ $survey->nm_survey }}"
                                    class="form-control">
                                @error('nm_survey')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kategori_id">Kategori Survey</label>
                                        <select name="kategori_id" id="kategori_id" class="form-control">
                                            @foreach ($kategories as $kategori)
                                                <option value="{{ $kategori->id }}"
                                                    @if ($survey->kategori_id == $kategori->id) selected @endif>
                                                    {{ $kategori->kategori_survey }}
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
                                            @foreach ($periodes as $periode)
                                                <option value="{{ $periode->id }}"
                                                    @if ($survey->periode_id == $periode->id) selected @endif>
                                                    {{ $periode->periode }}
                                                </option>
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
                                        <select name="responden_id" id="responden_id" class="form-control">
                                            @foreach ($respondens as $responden)
                                                <option value="{{ $responden->id }}"
                                                    @if ($survey->responden_id == $responden->id) selected @endif>
                                                    {{ $responden->role }}
                                                </option>
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
                            <button type="submit" class="btn btn-success mt-4 float-right">Update Survey</button>

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
            var pertanyaanData =
                {!! json_encode($survey->pertanyaans) !!}; // Assuming you have a relationship called 'pertanyaans' in your Survey model

            // Iterate over the existing pertanyaan data and append them to the form
            pertanyaanData.forEach(function(pertanyaan) {
                addPertanyaanField(pertanyaan.pertanyaan, pertanyaan.jenis_jawaban_id);
            });

            var counter = pertanyaanData.length || 1; // Use the number of existing pertanyaans, or default to 1

            $('#addPertanyaan').click(function() {
                addPertanyaanField('', '');
            });

            $(document).on('click', '.removePertanyaan', function() {
                $(this).closest('.form-group').remove();
                counter--;
            });

            function addPertanyaanField(pertanyaanValue, jenisJawabanValue) {
                var newDiv = $('<div>', {
                    class: 'form-group row',
                    style: 'margin-bottom: 15px;'
                });

                var newInputPertanyaan = $('<input>', {
                    type: 'text',
                    name: 'pertanyaan[]',
                    value: pertanyaanValue,
                    class: 'form-control col-md-6',
                    placeholder: 'Tulis pertanyaan... '
                });

                var newSelectJenisSkalaLikert = $('<select>', {
                    name: 'jenis_jawaban_id[]',
                    class: 'form-control col-md-4'
                });

                $.each(jenisPertanyaan, function(index, jenis) {
                    var option = $('<option>', {
                        value: jenis.id,
                        text: jenis.jenis_jawaban
                    });

                    // If the jenis_jawaban_id matches, select this option
                    if (jenis.id == jenisJawabanValue) {
                        option.attr('selected', 'selected');
                    }

                    newSelectJenisSkalaLikert.append(option);
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
            }
        });
    </script>
@endsection
