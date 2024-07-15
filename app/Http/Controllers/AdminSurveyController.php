<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Survey;
use App\Models\Periode;
use App\Models\Kategori;
use App\Models\Pertanyaan;
use App\Models\JenisJawaban;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.survey.index', [
            'surveys'   => Survey::with(['kategori', 'periode', 'responden'])->orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.survey.create', [
            'kategories'    => Kategori::all(),
            'periodes'      => Periode::all(),
            'jenisJawabans' => JenisJawaban::all(),
            'respondens'    => Role::whereNot('id', '1')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nm_survey'             => 'required|string',
            'kategori_id'           => 'required',
            'periode_id'            => 'required',
            'responden_id'          => 'required',
            'pertanyaan'            => 'required|array',
            'pertanyaan.*'          => 'required|string',
            'jenis_jawaban_id'      => 'required|array',
            'jenis_jawaban_id.*'    => 'required|exists:jenis_jawabans,id',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'exists'   => 'Nilai yang dipilih untuk :attribute tidak valid.',
            'string'   => 'Kolom :attribute harus berupa teks.',
        ]);

        $survey = Survey::create([
            'nm_survey'     => $validatedData['nm_survey'],
            'kategori_id'   => $validatedData['kategori_id'],
            'periode_id'    => $validatedData['periode_id'],
            'responden_id'  => $validatedData['responden_id'],
        ]);

        foreach ($validatedData['pertanyaan'] as $key => $pertanyaan) {
            Pertanyaan::create([
                'survey_id'         => $survey->id,
                'pertanyaan'        => $pertanyaan,
                'jenis_jawaban_id'  => $validatedData['jenis_jawaban_id'][$key],
            ]);
        }

        return redirect('/admin/survey')->with('success', 'Survey berhasil ditambahkan');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $survey = Survey::with(['kategori', 'periode'])->find($id);
        return view('admin.survey.edit', [
            'survey'        => $survey,
            'kategories'    => Kategori::all(),
            'periodes'      => Periode::all(),
            'jenisJawabans' => JenisJawaban::all(),
            'respondens'    => Role::whereNot('id', '1')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nm_survey'     => 'required|string',
            'kategori_id'   => 'required',
            'periode_id'    => 'required',
            'responden_id'  => 'required',
            'pertanyaan'    => 'required|array',
            'pertanyaan.*'  => 'required|string',
            'jenis_jawaban_id'      => 'required|array',
            'jenis_jawaban_id.*'    => 'required|exists:jenis_jawabans,id',
        ]);

        $survey = Survey::findOrFail($id);

        $survey->nm_survey      = $validatedData['nm_survey'];
        $survey->kategori_id    = $validatedData['kategori_id'];
        $survey->periode_id     = $validatedData['periode_id'];
        $survey->responden_id   = $validatedData['responden_id'];
        $survey->save();


        $survey->pertanyaans()->delete();

        foreach ($validatedData['pertanyaan'] as $key => $pertanyaan) {
            $survey->pertanyaans()->create([
                'pertanyaan' => $pertanyaan,
                'jenis_jawaban_id' => $validatedData['jenis_jawaban_id'][$key],
            ]);
        }

        return redirect('/admin/survey')->with('success', 'Survey berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $survey = Survey::with(['kategori', 'periode', 'responden'])->find($id);
        $survey->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus !');
    }

    public function updateStatus(Request $request, $id)
    {
        $survey = Survey::findOrFail($id);
        $request->validate([
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        $survey->status = $request->status;
        $survey->save();

        return response()->json(['message' => 'Status berhasil diperbarui']);
    }
}