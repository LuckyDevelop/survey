<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\User;
use App\Models\Survey;
use App\Models\Jawaban;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\pdf as PDF;
use PhpOffice\PhpWord\IOFactory;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use PhpOffice\PhpWord\TemplateProcessor;

class HasilSurveyController extends Controller
{
    public function index()
    {
        return view('admin.hasil-survey.index', [
            'surveys'   => Survey::orderBy('id', 'DESC')->get()
        ]);
    }

    public function show($id)
    {
        $survey = Survey::find($id);
        $pertanyaans = Pertanyaan::with('jenis_jawaban.listJawabans')
            ->where('survey_id', $survey->id)
            ->get();

        $respondens = User::whereHas('jawabans', function ($query) use ($survey) {
            $query->whereHas('pertanyaan', function ($query) use ($survey) {
                $query->where('survey_id', $survey->id);
            });
        })
        ->orderBy('created_at', 'desc')
        ->get();

        return view('admin.hasil-survey.show', [
            'pertanyaans'   => $pertanyaans,
            'respondens'    => $respondens,
            'survey'        => $survey,
        ]);
    }

    public function surveyResponden($id, $survey_id)
    {
        $survey = Survey::find($survey_id);
        $jawabanResponden = Jawaban::where('responden_id', $id)
            ->whereHas('pertanyaan', function ($query) use ($survey_id) {
                $query->where('survey_id', $survey_id);
            })
            ->with('pertanyaan')
            ->get();

        $pertanyaans = Pertanyaan::where('survey_id', $survey_id)->get();

        return view('admin.hasil-survey.survey-responden', [
            'jawabanResponden' => $jawabanResponden,
            'survey' => $survey,
            'pertanyaans' => $pertanyaans,
        ]);
    }

    public function rekapSurvey($id)
    {
        $survey = Survey::findOrFail($id);
        $pertanyaans = $survey->pertanyaans;

        $dataJawaban = [];

        foreach ($pertanyaans as $pertanyaan) {
            $jawabans = $pertanyaan->jawabans;
            $jumlahJawaban = [];
            foreach ($jawabans as $jawaban) {
                $key = $pertanyaan->jenis_jawaban->input_type_id === 1 ? $jawaban->jawaban : $jawaban->jawaban;

                if (!isset($jumlahJawaban[$key])) {
                    $jumlahJawaban[$key] = 0;
                }

                $jumlahJawaban[$key]++;
            }

            $tipeChart = $pertanyaan->jenis_jawaban->input_type_id === 1 ? 'bar' : 'pie';

            $dataJawaban[] = [
                'pertanyaan' => $pertanyaan->pertanyaan,
                'jawaban' => $jumlahJawaban,
                'tipeChart' => $tipeChart,
            ];

        }

        return view('admin.hasil-survey.rekap-survey', compact('survey', 'dataJawaban'));
    }

    public function printPdf($id)
    {
        $survey = Survey::findOrFail($id);
        $pertanyaans = $survey->pertanyaans;
        $dataJawaban = [];

        foreach ($pertanyaans as $pertanyaan) {
            $jawabans = $pertanyaan->jawabans;
            $jumlahJawaban = [];
            foreach ($jawabans as $jawaban) {
                $key = $pertanyaan->jenis_jawaban->input_type_id === 1 ? $jawaban->jawaban : $jawaban->jawaban;

                if (!isset($jumlahJawaban[$key])) {
                    $jumlahJawaban[$key] = 0;
                }

                $jumlahJawaban[$key]++;
            }

            $tipeChart = $pertanyaan->jenis_jawaban->input_type_id === 1 ? 'bar' : 'pie';

            $dataJawaban[] = [
                'pertanyaan' => $pertanyaan->pertanyaan,
                'jawaban'   => $jumlahJawaban,
                'tipeChart' => $tipeChart,
            ];
        }

        $html = view('admin.hasil-survey.print-pdf', compact('survey', 'dataJawaban'))->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream();
    }

    public function cetakPdf($id)
    {
        $survey = Survey::findOrFail($id);
        $dataJawaban = $this->prepareChartData($survey);
        $chartUrls = $this->prepareChartUrls($dataJawaban);

        $pdf = \PDF::loadView('admin.hasil-survey.pdf', compact('dataJawaban', 'chartUrls'));
        $tempPdfPath = storage_path('app/temp_survey_report.pdf');
        $pdf->save($tempPdfPath);

        $templatePath = public_path('assets/template/template.pdf');

        $pdfMerger = PDFMerger::init();
        $pdfMerger->addPDF($templatePath, 'all');
        $pdfMerger->addPDF($tempPdfPath, 'all');
        $pdfMerger->merge();
        $filename = 'cetak-pdf.pdf';
        return $pdfMerger->stream($filename);
        unlink($tempPdfPath);
    }

    public function cetakWord($id)
    {
        // Load the survey
        $survey = Survey::findOrFail($id);
        $dataJawaban = $this->prepareChartData($survey);
        $chartUrls = $this->prepareChartUrls($dataJawaban);

        // Creating the new document...
        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('assets/template/template.docx');

        // Iterate over chart URLs and download the images
        foreach ($chartUrls as $index => $chartUrl) {
            $imagePath = 'assets/hasil-survey/image_' . ($index + 1) . '.jpg';

            // Download the image
            file_put_contents($imagePath, file_get_contents($chartUrl));

            // Replace the placeholder with the downloaded image
            $placeholder = 'gambar_' . ($index + 1);
            $phpWord->setImageValue($placeholder, [
                'path' => $imagePath,
                'width' => 600,
                'height' => 400,
                'ratio' => true
            ]);
        }

        // Save the processed document temporarily
        $tempFilePath = 'assets/hasil-survey/hasil-survey.docx';
        $phpWord->saveAs($tempFilePath);

        // Redirect to a route that displays the document in Google Docs Viewer
        return redirect()->route('showWordPreview', ['filePath' => $tempFilePath]);
    }

    public function showWordPreview(Request $request)
    {
        $filePath = $request->query('filePath');

        // Encode the file path to be used in the URL
        $encodedFilePath = urlencode(asset($filePath));

        // URL for Google Docs Viewer
        $googleDocsViewerUrl = "https://docs.google.com/gview?url={$encodedFilePath}&embedded=true";

        return view('admin.hasil-survey.word-preview', compact('googleDocsViewerUrl'));
    }


    private function prepareChartData($survey)
    {
        $pertanyaans = $survey->pertanyaans;
        $dataJawaban = [];

        foreach ($pertanyaans as $pertanyaan) {
            $jawabans = $pertanyaan->jawabans;
            $jumlahJawaban = [];

            foreach ($jawabans as $jawaban) {
                $key = $pertanyaan->jenis_jawaban->input_type_id === 1 ? $jawaban->jawaban : $jawaban->jawaban;

                if (!isset($jumlahJawaban[$key])) {
                    $jumlahJawaban[$key] = 0;
                }

                $jumlahJawaban[$key]++;
            }

            $dataJawaban[] = [
                'pertanyaan' => $pertanyaan->pertanyaan,
                'jawaban' => $jumlahJawaban,
                'totalResponden' => $pertanyaan->jawabans->count(), // Total responden untuk pertanyaan ini
            ];
        }

        return $dataJawaban;
    }

    private function prepareChartUrls($dataJawaban)
    {
        $chartUrls = [];

        foreach ($dataJawaban as $data) {
            $chartConfig = [
                'type' => 'bar',
                'data' => [
                    'labels' => array_keys($data['jawaban']),
                    'datasets' => [
                        [
                            'label' => 'Jumlah Jawaban',
                            'data' => array_values($data['jawaban'])
                        ]
                    ]
                ]
            ];

            $chartUrl = 'https://quickchart.io/chart?w=400&h=200&c=' . urlencode(json_encode($chartConfig));
            $chartUrls[] = $chartUrl;
        }

        return $chartUrls;
    }

    public function word($id = 1)
    {
        // Load the survey
        $survey = Survey::findOrFail($id);
        $dataJawaban = $this->prepareChartData($survey);
        $chartUrls = $this->prepareChartUrls($dataJawaban);

        // Creating the new document...
        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('assets/template/template.docx');

        // Iterate over chart URLs and download the images
        foreach ($chartUrls as $index => $chartUrl) {
            $imagePath = 'assets/hasil-survey/image_' . ($index + 1) . '.jpg';

            // Download the image
            file_put_contents($imagePath, file_get_contents($chartUrl));

            // Replace the placeholder with the downloaded image
            $placeholder = 'gambar_' . ($index + 1);
            $phpWord->setImageValue($placeholder, [
                'path' => $imagePath,
                'width' => 600,
                'height' => 400,
                'ratio' => true
            ]);
        }

        // Save the processed document temporarily
        $tempFilePath = 'assets/hasil-survey/temp.docx';
        $phpWord->saveAs($tempFilePath);

        // Load the .docx file for conversion to PDF
        \PhpOffice\PhpWord\Settings::setPdfRendererPath(base_path('vendor/dompdf/dompdf'));
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

        // Load the temporary Word document
        $phpWord = \PhpOffice\PhpWord\IOFactory::load($tempFilePath);

        // Create the PDF writer
        $pdfWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');

        // Define the path for the PDF file
        $pdfFilePath = 'assets/hasil-survey/hasil-survey.pdf';
        $pdfWriter->save($pdfFilePath);

        // Cleanup: Ensure the temporary files are closed and deleted
        unset($phpWord);
        unset($pdfWriter);
        sleep(1); // Wait a moment to ensure file handles are released

        if (file_exists($tempFilePath)) {
            unlink($tempFilePath);
        }

        // Set headers to prompt a download and delete the file after sending it
        return response()->download($pdfFilePath)->deleteFileAfterSend(true);
    }
}
