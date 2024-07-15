<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Jawaban;
use App\Models\Pertanyaan;
use App\Models\ListJawaban;
use App\Models\JenisJawaban;
use Illuminate\Http\Request;

class AdminIsiSurveyController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;

        // Mendapatkan semua survei yang tersedia untuk pengguna yang sedang masuk
        $surveys = Survey::where('status', 'aktif')
            ->where('responden_id', auth()->user()->role_id)
            ->orderBy('id', 'DESC')
            ->get();

        // Membuat array untuk menyimpan status pengisian survei
        $surveyStatus = [];

        // Memeriksa status pengisian survei untuk setiap survei
        foreach ($surveys as $survey) {
            $jawaban = Jawaban::join('pertanyaans', 'jawabans.pertanyaan_id', '=', 'pertanyaans.id')
                ->where('pertanyaans.survey_id', $survey->id)
                ->where('jawabans.responden_id', $user_id)
                ->exists();

            // Menentukan teks tombol berdasarkan status pengisian survei
            if ($jawaban) {
                $surveyStatus[$survey->id] = "Anda sudah mengisi";
            } else {
                $surveyStatus[$survey->id] = "Isi Survey";
            }
        }

        return view('admin.isi-survey.index', [
            'surveys'     => $surveys,
            'surveyStatus' => $surveyStatus
        ]);
    }

    public function create($id)
    {
        $pertanyaans = Pertanyaan::with(['jenis_jawaban.listJawabans', 'survey'])
            ->where('survey_id', $id)
            ->get();

        $survey = Survey::find($id);

        return view('admin.isi-survey.create', [
            'pertanyaans' => $pertanyaans,
            'survey' => $survey
        ]);
    }

    public function store(Request $request)
    {
        if (!$request->has('jawaban')) {
            return redirect()->back()->withErrors(['error' => 'Tidak ada jawaban yang diisi']);
        }

        foreach ($request->jawaban as $pertanyaan_id => $jawaban) {
            $jenisJawaban = Pertanyaan::findOrFail($pertanyaan_id)->jenis_jawaban->input_type_id;
            $jenis_jawaban_id = Pertanyaan::findOrFail($pertanyaan_id)->jenis_jawaban_id;
            if ($jenisJawaban == 1) {
                $listJawaban = ListJawaban::where('jenis_jawaban_id', $jenis_jawaban_id)
                    ->where('nilai', $jawaban)
                    ->first();

                Jawaban::create([
                    'pertanyaan_id' => $pertanyaan_id,
                    'responden_id'  => auth()->id(),
                    'nilai'         => $jawaban,
                    'jawaban'       => $listJawaban->label,
                ]);
            } else {
                Jawaban::create([
                    'pertanyaan_id' => $pertanyaan_id,
                    'responden_id'  => auth()->id(),
                    'jawaban'       => $jawaban,
                ]);
            }
        }

        return redirect('/admin/isi-survey/')->with('success', 'Berhasil mengisi survey');
    }
}