<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dosen.index', [
            'dosens'    => User::with('prodi')
                ->where('role_id', '2')
                ->orderBy('id', 'DESC')
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dosen.create', [
            'programStudies'    => ProgramStudi::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'no_induk'  => 'required|unique:users',
            'email'     => 'required|unique:users',
            'prodi_id'  => 'required',
            'password'  => 'required',
        ], [
            'name.required'     => 'Form tidak boleh kosong !',
            'no_induk.required' => 'Form tidak boleh kosong !',
            'no_induk.unique'   => 'NIDN tidak bole sama !',
            'email.required'    => 'Form tidak boleh kosong !',
            'email.unique'      => 'Email tidak bole sama !',
            'prodi_id.required' => 'Form tidak boleh kosong !',
            'password.required' => 'Form tidak boleh kosong !',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        User::create([
            'name'      => $request->name,
            'no_induk'  => $request->no_induk,
            'username'  => $request->no_induk,
            'email'     => $request->email,
            'prodi_id'  => $request->prodi_id,
            'role_id'   => $request->role_id,
            'password'  => $request->password
        ]);

        return redirect('/admin/dosen')->with('success', 'Berhasil menambahkan data !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dosen      = User::find($id);
        $prodies    = ProgramStudi::all();

        return view('admin.dosen.edit', [
            'dosen'     => $dosen,
            'prodies'   => $prodies
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dosen = User::find($id);
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'no_induk'  => 'required',
            'email'     => 'required',
            'prodi_id'  => 'required',
        ], [
            'name.required'     => 'Form tidak boleh kosong !',
            'no_induk.required' => 'Form tidak boleh kosong !',
            'email.required'    => 'Form tidak boleh kosong !',
            'prodi_id.required' => 'Form tidak boleh kosong !',
        ]);

        if ($request->no_induk != $dosen->no_induk && $request->email != $dosen->email) {
            $validator = Validator::make($request->all(), [
                'no_induk'          => 'unique:users',
                'email'             => 'unique:users,email',
            ], [
                'no_induk.unique'   => 'NIDN tidak boleh sama !',
                'email.unique'      => 'Email sudah digunakan !',
            ]);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $dosen->update([
            'name'      => $request->name,
            'no_induk'  => $request->no_induk,
            'username'  => $request->no_induk,
            'email'     => $request->email,
            'prodi_id'  => $request->prodi_id,
        ]);

        return redirect('/admin/dosen')->with('success', 'Berhasil memperbarui data !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dosen = User::find($id);
        $dosen->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
