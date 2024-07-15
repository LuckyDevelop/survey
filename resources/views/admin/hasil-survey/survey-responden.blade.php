@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Hasil Survey

                        <div class="ml-auto">
                            <a href="/admin/hasil-survey/" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if ($jawabanResponden->isEmpty())
                            <div class="alert alert-info" role="alert">
                                Belum ada jawaban dari responden ini untuk survei ini.
                            </div>
                        @else
                            <div class="list-group">
                                @foreach ($pertanyaans as $pertanyaan)
                                    <div class="list-group-item">
                                        <h5 class="mb-1">Pertanyaan:</h5>
                                        <p class="mb-1">{{ $pertanyaan->pertanyaan }}</p>
                                        <h6 class="mb-1">Jawaban:</h6>
                                        @php
                                            $jawaban = $jawabanResponden
                                                ->where('pertanyaan_id', $pertanyaan->id)
                                                ->first();
                                        @endphp
                                        @if ($jawaban)
                                            @if (is_array($jawaban->jawaban))
                                                @foreach ($jawaban->jawaban as $item)
                                                    <p class="mb-1">{{ $item['label'] }}</p>
                                                @endforeach
                                            @else
                                                <p class="mb-1">{{ $jawaban->jawaban }}</p>
                                            @endif
                                        @else
                                            <p class="mb-1">Belum ada jawaban untuk pertanyaan ini.</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
