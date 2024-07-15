<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminPeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.periode.index', [
            'periodes'    => Periode::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.periode.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'periode'   => 'required',
            'semester'  => 'required'
        ], [
            'periode.required'      => 'Form tidak boleh kosong !',
            'semester.required'     => 'Form tidak boleh kosong !',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Periode::create([
            'periode'    => $request->periode,
            'semester'   => $request->semester,
        ]);

        return redirect('/admin/periode')->with('success', 'Berhasil menambahkan data !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $periode = Periode::find($id);
        return view('admin.periode.edit', [
            'periode'  => $periode
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $periode = Periode::find($id);
        $validator = Validator::make($request->all(), [
            'periode'   => 'required',
            'semester'  => 'required'
        ], [
            'periode.required'      => 'Form tidak boleh kosong !',
            'semester.required'     => 'Form tidak boleh kosong !',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $periode->update([
            'periode'    => $request->periode,
            'semester'   => $request->semester,
        ]);

        return redirect('/admin/periode')->with('success', 'Berhasil memperbarui data !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $periode = Periode::find($id);
        $periode->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
