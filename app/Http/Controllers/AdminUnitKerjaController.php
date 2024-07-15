<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminUnitKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.unit-kerja.index', [
            'unitKerjas'    => User::with('prodi')
                ->where('role_id', '4')
                ->orderBy('id', 'DESC')
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.unit-kerja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'username'  => 'required|unique:users',
            'email'     => 'required|unique:users',
            'password'  => 'required'
        ], [
            'name.required'     => 'Form tidak boleh kosong!',
            'username.required' => 'Form tidak boleh kosong!',
            'username.unique'   => 'Username tidak boleh sama !',
            'email.required'    => 'Form tidak boleh kosong!',
            'email.unique'      => 'Email tidak boleh sama !',
            'password.required' => 'Form tidak boleh kosong!'
        ]);


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'role_id'   => $request->role_id,
            'password'  => $request->password
        ]);

        return redirect('/admin/unit-kerja')->with('success', 'Berhasil menambahkan data !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $unitKerja = User::find($id);
        return view('admin.unit-kerja.edit', [
            'unitKerja' => $unitKerja
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $unitKerja = User::find($id);
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'username'  => 'required',
            'email'     => 'required',
        ], [
            'name.required'     => 'Form tidak boleh kosong !',
            'username.required' => 'Form tidak boleh kosong !',
            'email.required'    => 'Form tidak boleh kosong !',
        ]);

        if ($request->username != $unitKerja->username && $request->email != $unitKerja->email) {
            $validator = Validator::make($request->all(), [
                'username'          => 'unique:users',
                'email'             => 'unique:users',
            ], [
                'no_induk.unique'   => 'Username tidak boleh sama !',
                'email.unique'      => 'Email sudah digunakan !',
            ]);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $unitKerja->update([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
        ]);

        return redirect('/admin/unit-kerja')->with('success', 'Berhasil memperbarui data !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unitKerja = User::find($id);
        $unitKerja->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data!');
    }
}
