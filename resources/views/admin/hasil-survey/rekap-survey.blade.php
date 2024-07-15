@extends('admin.layouts.main')
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .print-section,
        .print-section * {
            visibility: visible;
        }

        .print-section .row {
            display: flex;
            flex-wrap: wrap;
        }

        .print-section .row>div {
            width: 50%;
        }

        .print-section .card {
            max-width: none;
        }
    }
</style>

@section('content')
    <div class="section-header">
        <h1>Data Hasil Survey</h1>
        <div class="ml-auto">
            {{-- <button id="printButton" class="btn btn-danger">Cetak Laporan</button> --}}
            <a href="{{ route('cetak_word', ['id' => $survey->id]) }}" target="_blank" class="btn btn-danger">Cetak Laporan</a>
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
                <div class="card card-primary print-section">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($dataJawaban as $data)
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">{{ $data['pertanyaan'] }}</div>
                                        <div class="card-body">
                                            <canvas id="chart-{{ Str::slug($data['pertanyaan']) }}" width="400"
                                                height="400"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            Rekapitulasi Data
                                        </div>
                                        <div class="card-body">
                                            <table
                                                class="table table-bordered table-hover table-striped table-condensed mt-3">
                                                <thead>
                                                    <tr>
                                                        <th>Jawaban</th>
                                                        <th>Responden</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data['jawaban'] as $jawaban => $jumlah)
                                                        <tr>
                                                            <td>{{ $jawaban }}</td>
                                                            <td>{{ $jumlah }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot style="background-color: gainsboro">
                                                    @php
                                                        $total_responden = array_sum($data['jawaban']);
                                                    @endphp
                                                    <tr>
                                                        <td>Total Responden :</td>
                                                        <td>{{ $total_responden }}</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($dataJawaban as $data)
                var ctx = document.getElementById('chart-{{ Str::slug($data['pertanyaan']) }}').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: '{{ $data['tipeChart'] }}',
                    data: {
                        labels: {!! json_encode(array_keys($data['jawaban'])) !!},
                        datasets: [{
                            label: '{{ $data['pertanyaan'] }}',
                            data: {!! json_encode(array_values($data['jawaban'])) !!},
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        plugins: {
                            title: {
                                display: true,
                                text: '{{ $data['pertanyaan'] }}',
                            },
                            legend: {
                                display: true,
                            },
                            tooltip: {
                                displayColors: false,
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                    precision: 0
                                }
                            }
                        }
                    }
                });
            @endforeach

            // document.getElementById('printButton').addEventListener('click', function() {
            //     window.print();
            // });
        });
    </script>
@endsection
