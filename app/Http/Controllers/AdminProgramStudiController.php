<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminProgramStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.program-studi.index', [
            'programStudies'    => ProgramStudi::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.program-studi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'program_studi' => 'required',
        ], [
            'program_studi.required'    => 'Form tidak boleh kosong !',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        ProgramStudi::create([
            'program_studi'    => $request->program_studi
        ]);

        return redirect('/admin/program-studi')->with('success', 'Berhasil menambahkan data !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $programStudi = ProgramStudi::find($id);
        return view('admin.program-studi.edit', [
            'programStudi'  => $programStudi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $programStudi = ProgramStudi::find($id);
        $validator = Validator::make($request->all(), [
            'program_studi' => 'required',
        ], [
            'program_studi.required'    => 'Form tidak boleh kosong !',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $programStudi->update([
            'program_studi'    => $request->program_studi
        ]);

        return redirect('/admin/program-studi')->with('success', 'Berhasil memperbarui data !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $programStudi = ProgramStudi::find($id);
        $programStudi->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
