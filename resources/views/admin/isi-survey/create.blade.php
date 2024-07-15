@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><b>{{ $survey->kategori->kategori_survey }}</b></div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="surveyForm" action="/admin/isi-survey" method="POST">
                            @csrf
                            <h4>{{ $survey->nm_survey }}</h4>
                            @php
                                $questionNumber = 1;
                                $perPage = 15;
                            @endphp
                            <div id="questions-container">
                                @foreach ($pertanyaans as $pertanyaan)
                                    @if ($loop->index % $perPage === 0)
                                        <div class="page-group" data-page-number="{{ intval($loop->index / $perPage) + 1 }}"
                                            style="display: none;">
                                    @endif
                                    <div class="form-group question-group">
                                        <label for="pertanyaan_{{ $pertanyaan->id }}">{{ $questionNumber }}.
                                            {{ $pertanyaan->pertanyaan }}</label>
                                        @php $questionNumber++; @endphp
                                        @if ($pertanyaan->jenis_jawaban->input_type_id === 1)
                                            <div>
                                                @foreach ($pertanyaan->jenis_jawaban->listJawabans as $jawaban)
                                                    <label>
                                                        <input type="radio" name="jawaban[{{ $pertanyaan->id }}]"
                                                            value="{{ $jawaban->nilai }}" required>
                                                        {{ $jawaban->label }}
                                                    </label>
                                                    <br>
                                                @endforeach
                                            </div>
                                        @elseif ($pertanyaan->jenis_jawaban->input_type_id === 2)
                                            <div>
                                                <textarea name="jawaban[{{ $pertanyaan->id }}]" id="pertanyaan_{{ $pertanyaan->id }}" class="form-control"
                                                    rows="4" required></textarea>
                                            </div>
                                        @elseif ($pertanyaan->jenis_jawaban->input_type_id === 3)
                                            <textarea name="jawaban[{{ $pertanyaan->id }}]" id="pertanyaan_{{ $pertanyaan->id }}" class="form-control"
                                                rows="4" required></textarea>
                                        @elseif ($pertanyaan->jenis_jawaban->input_type_id === 4)
                                            <select name="jawaban[{{ $pertanyaan->id }}]"
                                                id="pertanyaan_{{ $pertanyaan->id }}" class="form-control" required>
                                                @foreach ($pertanyaan->jenis_jawaban->listJawabans as $jawaban)
                                                    <option value="{{ $jawaban->label }}">{{ $jawaban->label }}</option>
                                                @endforeach
                                            </select>
                                        @elseif ($pertanyaan->jenis_jawaban->input_type_id === 5)
                                            <input type="number" name="jawaban[{{ $pertanyaan->id }}]"
                                                id="pertanyaan_{{ $pertanyaan->id }}" class="form-control" required>
                                        @endif
                                    </div>
                                    @if (($loop->index + 1) % $perPage === 0 || $loop->last)
                            </div>
                            @endif
                            @endforeach
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="button" id="prev-btn" class="btn btn-secondary" style="display: none;">Back</button>
                        <button type="button" id="next-btn" class="btn btn-primary">Next</button>
                        <button type="submit" id="submit-btn" class="btn btn-primary"
                            style="display: none;">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            let currentPage = 1;
            const totalPages = $('.page-group').length;

            function showPage(page) {
                $('.page-group').hide();
                $(`.page-group[data-page-number=${page}]`).show();
            }

            function updateButtons() {
                $('#prev-btn').toggle(currentPage > 1);
                $('#next-btn').toggle(currentPage < totalPages);
                $('#submit-btn').toggle(currentPage === totalPages);
            }

            function validatePage() {
                let valid = true;
                $(`.page-group[data-page-number=${currentPage}]`).find('input, textarea, select').each(function() {
                    if (!$(this).val()) {
                        valid = false;
                    }
                });
                return valid;
            }

            showPage(currentPage);
            updateButtons();

            $('#next-btn').click(function() {
                if (validatePage()) {
                    currentPage++;
                    showPage(currentPage);
                    updateButtons();
                } else {
                    alert('Please answer all questions before proceeding.');
                }
            });

            $('#prev-btn').click(function() {
                currentPage--;
                showPage(currentPage);
                updateButtons();
            });

            $('#surveyForm').submit(function() {
                if (!validatePage()) {
                    alert('Please answer all questions before submitting.');
                    return false;
                }
            });
        });
    </script>
@endsection
