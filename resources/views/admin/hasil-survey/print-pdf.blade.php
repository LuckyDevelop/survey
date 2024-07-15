<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Hasil Survey</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
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

                $(document).ready(function() {
                    $('#table_{{ Str::slug($data['pertanyaan']) }}').DataTable();
                });
            @endforeach
        });
    </script>
</head>

<body>
    <div class="section-header">
        <h1>Data Hasil Survey</h1>
    </div>

    <div class="section-body">
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
                        <div class="card-header">Rekapitulasi Data</div>
                        <div class="card-body">
                            <table id="table_{{ Str::slug($data['pertanyaan']) }}"
                                class="table table-bordered table-hover table-striped table-condensed mt-3">
                                <thead>
                                    <tr>
                                        <th>Jawaban</th>
                                        <th>Jumlah Responden</th>
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
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>

</html>
