<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use App\Models\User;
use App\Models\Survey;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jumlahDosen    = User::where('role_id', '2')->count();
        $jumlahMhs      = User::where('role_id', '3')->count();
        $totalSurvey    = Survey::count();
        $totalProdi     = ProgramStudi::count();
        $allSurvey      = Survey::orderBy('id', 'DESC')->get();
        $userSurvey     = Survey::where('responden_id', auth()->user()->role_id)->orderBy('id', 'DESC')->get();

        return view('admin.dashboard', [
            'jumlahDosen'   => $jumlahDosen,
            'jumlahMhs'     => $jumlahMhs,
            'totalSurvey'   => $totalSurvey,
            'totalProdi'    => $totalProdi,
            'allSurvey'     => $allSurvey,
            'userSurvey'    => $userSurvey
        ]);
    }
}