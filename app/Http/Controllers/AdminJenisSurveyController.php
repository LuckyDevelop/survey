<?php

namespace App\Http\Controllers;

use App\Models\InputType;
use App\Models\ListJawaban;
use App\Models\JenisJawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminJenisSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.jenis-survey.index', [
            'jenisSurveys'  => JenisJawaban::with('listJawabans')
                ->orderBy('id', 'DESC')
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jenis-survey.create', [
            'inputTypes' => InputType::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_jawaban' => 'required|string|max:255',
            'input_type_id' => 'required',
        ]);

        $jenisJawaban = JenisJawaban::create([
            'jenis_jawaban' => $request->jenis_jawaban,
            'input_type_id' => $request->input_type_id,
        ]);

        $labels = $request->input('label');
        $nilais = $request->input('nilai');

        if ($labels) {
            foreach ($labels as $index => $label) {
                $listJawaban = new ListJawaban();
                $listJawaban->jenis_jawaban_id = $jenisJawaban->id;
                $listJawaban->label = $label;

                if (isset($nilais[$index])) {
                    $listJawaban->nilai = $nilais[$index];
                }

                $listJawaban->save();
            }
        }

        return redirect('/admin/jenis-survey')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jenisJawaban = JenisJawaban::with(['inputType', 'listJawabans'])->find($id);
        return view('admin.jenis-survey.edit', [
            'inputTypes'    => InputType::all(),
            'jenisJawaban'  => $jenisJawaban
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_jawaban' => 'required|string|max:255',
            'input_type_id' => 'required|exists:input_types,id',
            'label' => 'array|required',
            'nilai' => 'array|nullable',
        ]);

        $jenisJawaban = JenisJawaban::findOrFail($id);
        $jenisJawaban->jenis_jawaban = $request->jenis_jawaban;
        $jenisJawaban->input_type_id = $request->input_type_id;
        $jenisJawaban->save();

        $listJawabansData = [];
        foreach ($request->label as $key => $label) {
            $listJawaban = [
                'jenis_jawaban_id' => $jenisJawaban->id,
                'label' => $label,
            ];

            if ($request->input_type_id == 1 && isset($request->nilai[$key])) {
                $listJawaban['nilai'] = $request->nilai[$key];
            }

            $listJawabansData[] = $listJawaban;
        }

        $jenisJawaban->listJawabans()->delete();
        ListJawaban::insert($listJawabansData);

        return redirect('/admin/jenis-survey')->with('success', 'Jenis survey berhasil diperbarui.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenisJawaban = JenisJawaban::with(['inputType', 'listJawabans'])->find($id);
        $jenisJawaban->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
