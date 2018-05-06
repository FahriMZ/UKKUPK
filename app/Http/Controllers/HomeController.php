<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\TahunAktif;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahunAktif = TahunAktif::join('tahun_ajar', 'tahun_aktif.id_tahun_ajar', 'tahun_ajar.id_tahun_ajar')->first()['tahun_ajar'];

        if($tahunAktif == null) {
            return redirect(route('set-tahun-aktif'));
        }

        if(Auth::user()->akses == 'administrator') {
            return view('admin.home', compact('tahunAktif'));
        }else if(Auth::user()->akses == 'asesor'){
            return view('asesor.home');
        }else{
            return view('welcome');
        }
    }
}
