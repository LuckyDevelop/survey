<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AdminTenagaPendidikController extends Controller
{
    /**ā
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tenaga-pendidik.index', [
            'tenagaPendidiks' => User::where('role_id', '5')
                ->orderBy('id', 'DESC')
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tenaga-pendidik.create');
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
            'status_pegawai'  => 'required',
            'jabatan'  => 'required',
            'password'  => 'required',
        ], [
            'name.required'     => 'Form tidak boleh kosong !',
            'no_induk.required' => 'Form tidak boleh kosong !',
            'no_induk.unique'   => 'NPM tidak bole sama !',
            'email.required'    => 'Form tidak boleh kosong !',
            'email.unique'      => 'Email tidak bole sama !',
            'status_pegawai.required' => 'Status Pegawai harus di pilih !',
            'jabatan.required' => 'Jabatan harus di pilih !',
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
            'status_pegawai'  => $request->status_pegawai,
            'jabatan'  => $request->jabatan,
            'role_id'   => $request->role_id,
            'password'  => $request->password
        ]);

        return redirect('/admin/tenaga-pendidik')->with('success', 'Berhasil menambahkan data !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tenaga_pendidik   = User::find($id);

        return view('admin.tenaga-pendidik.edit', [
            'tenaga_pendidik' => $tenaga_pendidik,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mahasiswa = User::find($id);

        if (!$mahasiswa) {
            return redirect('/admin/tenaga-pendidik')->with('error', 'Data tidak ditemukan!');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'no_induk' => 'required|unique:users,no_induk,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'status_pegawai' => 'required',
            'jabatan' => 'required',
        ], [
            'name.required' => 'Form tidak boleh kosong !',
            'no_induk.required' => 'Form tidak boleh kosong !',
            'email.required' => 'Form tidak boleh kosong !',
            'email.email' => 'Format email tidak valid !',
            'status_pegawai.required' => 'Status Pegawai wajib dipilih !',
            'jabatan.required' => 'Jabatan wajib dipilih !',
            'no_induk.unique' => 'NIP tidak boleh sama !',
            'email.unique' => 'Email sudah digunakan !',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $statusPegawai = $request->status_pegawai == 'Lainnya' ? $request->status_pegawai_lainnya : $request->status_pegawai;

        $mahasiswa->update([
            'name' => $request->name,
            'no_induk' => $request->no_induk,
            'username' => $request->no_induk,
            'email' => $request->email,
            'status_pegawai' => $statusPegawai,
            'jabatan' => $request->jabatan,
        ]);

        return redirect('/admin/tenaga-pendidik')->with('success', 'Berhasil memperbarui data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tenaga_pendidik = User::find($id);
        $tenaga_pendidik->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
