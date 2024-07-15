<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Survey Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .pertanyaan {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }

        .pertanyaan h3 {
            margin-bottom: 10px;
        }

        .chart-container {
            margin-bottom: 20px;
            text-align: center;
        }

        .chart-container img {
            max-width: 100%;
            height: auto;
            display: inline-block;
        }

        .rekap {
            padding: 10px;
        }

        .rekap table {
            width: 100%;
            border-collapse: collapse;
        }

        .rekap table th,
        .rekap table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Survey Report</h1>
    @foreach ($dataJawaban as $index => $data)
        <div class="pertanyaan">
            <h3>{{ $index + 1 }}. {{ $data['pertanyaan'] }}</h3>
            <table>
                <tr>
                    <td>
                        <div class="chart-container">
                            <img src="{{ $chartUrls[$index] }}" alt="Chart">
                        </div>
                    </td>
                    <td>
                        <div class="rekap">
                            <table>
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
                                    <tr>
                                        <td>Total Responden :</td>
                                        <td>{{ $data['totalResponden'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    @endforeach
</body>

</html>
