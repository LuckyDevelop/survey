@extends('admin.layouts.main')

@section('content')
    <div class="section-header">
        <h1>Edit Jenis Survey</h1>
        <div class="ml-auto">
            <a href="/admin/jenis-survey" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-body">
                        <form action="/admin/jenis-survey/{{ $jenisJawaban->id }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div id="inputFormRow">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="jenis_jawaban">Jenis Jawaban Survey</label>
                                            <input type="text" class="form-control" name="jenis_jawaban"
                                                value="{{ $jenisJawaban->jenis_jawaban }}">
                                        </div>
                                        @error('jenis_jawaban')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="input_type_id">Input Type</label>
                                            <select name="input_type_id" id="input_type_id" class="form-control">
                                                <option value="">-- Pilih Input Type --</option>
                                                @foreach ($inputTypes as $inputType)
                                                    <option value="{{ $inputType->id }}"
                                                        {{ $jenisJawaban->inputType->id == $inputType->id ? 'selected' : '' }}>
                                                        {{ $inputType->input_type }}</option>
                                                @endforeach
                                            </select>
                                            @error('input_type_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div id="dynamicFormContainer">
                                    @foreach ($jenisJawaban->listJawabans as $jawaban)
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="label">Label</label>
                                                <input type="text" name="label[]" class="form-control"
                                                    value="{{ $jawaban->label }}">
                                            </div>
                                            @if ($jenisJawaban->inputType->id == 1)
                                                <div class="col-md-4">
                                                    <label for="nilai">Nilai Skala Likert</label>
                                                    <input type="text" name="nilai[]" class="form-control"
                                                        value="{{ $jawaban->nilai }}">
                                                </div>
                                            @endif
                                            <div class="col-md-2 mt-4">
                                                <button type="button" class="btn btn-danger btn deleteForm">Hapus</button>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>

                                <div class="mb-3">
                                    <button id="addForm" type="button" class="btn btn-primary">Tambah Form</button>
                                    <button type="submit" class="btn btn-success float-right">Update</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('input_type_id').addEventListener('change', function() {
            var selectedOption = this.value;
            var dynamicFormContainer = document.getElementById('dynamicFormContainer');
            dynamicFormContainer.innerHTML = '';

            // Update dynamic form based on selected input type
            if (selectedOption === '1') {
                dynamicFormContainer.innerHTML = `
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="label">Label</label>
                            <input type="text" name="label[]" class="form-control">
                        </div>
                         <div class="col-md-4">
                            <label for="radioValues">Nilai Skala Likert</label>
                            <input type="text" name="nilai[]" class="form-control">
                        </div>
                        <div class="col-md-4 mt-4">
                            <button type="button" class="btn btn-danger btn deleteForm">Hapus</button>
                        </div>
                    </div>
                    <hr>
                `;
            } else if (selectedOption === '4') {
                dynamicFormContainer.innerHTML = `
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="label">Label</label>
                            <input type="text" name="label[]" class="form-control">
                        </div>
                        <div class="col-md-4 mt-4">
                            <button type="button" class="btn btn-danger btn deleteForm">Hapus</button>
                        </div>
                    </div>
                    <hr>
                `;
            } else if (selectedOption === '2') {
                dynamicFormContainer.innerHTML = `
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="label">Label</label>
                            <input type="text" name="label[]" class="form-control">
                        </div>
                        <div class="col-md-4 mt-4">
                            <button type="button" class="btn btn-danger btn deleteForm">Hapus</button>
                        </div>
                    </div>
                    <hr>
                `;
            }
        });

        document.getElementById('addForm').addEventListener('click', function() {
            var formContainer = document.getElementById('dynamicFormContainer');
            var clonedForm = formContainer.children[0].cloneNode(true);
            formContainer.appendChild(clonedForm);
        });

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('deleteForm')) {
                event.target.closest('.form-group').remove();
            }
        });
    </script>
@endsection
