<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Peserta;
use App\TahunAjar;
use App\TahunAktif;

class PesertaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun_aktif = TahunAktif::join('tahun_ajar', 'tahun_aktif.id_tahun_ajar', 'tahun_ajar.id_tahun_ajar')->first();

        // dd($tahun_aktif);
        // $peserta = Peserta::all();

        if(isset($_GET['q'])) {
            $peserta = Peserta::where('nama', 'LIKE', '%'.$_GET['q'].'%')
                        ->where('id_tahun_ajar', $tahun_aktif['id_tahun_ajar'])->paginate(7);
        }else{
            $peserta = Peserta::where('id_tahun_ajar', $tahun_aktif['id_tahun_ajar'])->paginate(7);
        }

        return view('admin.peserta.index', compact('peserta', 'tahun_aktif'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tahunAjar = TahunAjar::all();
        return view('admin.peserta.create', compact('tahunAjar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        Peserta::create([
            'id_peserta'        => $data['id_peserta'],
            'nama'              => $data['nama'],
            'jenis_kelamin'     => $data['jenis_kelamin'],
            'tanggal_lahir'     => $data['tanggal_lahir'],
            'alamat'            => $data['alamat'],
            'kontak'            => $data['kontak'],
            'email'             => $data['email'],
            'id_tahun_ajar'     => $data['id_tahun_ajar']
        ]);

        return redirect(route('admin.peserta.index'))->with('notification', 'Action completed');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peserta = Peserta::findOrFail($id);
        return view('admin.peserta.show', compact('peserta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $peserta = Peserta::findOrFail($id);
        $tahunAjar = TahunAjar::all();
        return view('admin.peserta.edit', compact('peserta', 'tahunAjar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $data
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data, $id)
    {
        Peserta::findOrFail($id)->update([
            'nama'              => $data['nama'],
            'jenis_kelamin'     => $data['jenis_kelamin'],
            'tanggal_lahir'     => $data['tanggal_lahir'],
            'alamat'            => $data['alamat'],
            'kontak'            => $data['kontak'],
            'email'             => $data['email'],
            'id_tahun_ajar'     => $data['id_tahun_ajar']
        ]);

        return redirect(route('admin.peserta.index'))->with('notification', 'Action completed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $peserta = Peserta::findOrFail($id);

        if($peserta->penilaian->count() > 0) {
            return redirect(route('admin.peserta.index'))->with('notification', 'Siswa memiliki penilaian');
        } else {
            $peserta->delete();

            return redirect(route('admin.peserta.index'))->with('notification', 'Action completed');
        }

    }
}
