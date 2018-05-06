<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TahunAktif;
use App\Peserta;
use App\Penilaian;
use App\DetailPenilaian;
use App\Komponen;
use App\DetailKomponen;

use Auth;

class PenilaianController extends Controller
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
        $tahunAktif = TahunAktif::first();
        
        if(isset($_GET['q'])) {
            $peserta = Peserta::where('id_tahun_ajar', $tahunAktif->id_tahun_ajar)
                                    ->where('nama', 'LIKE', '%'.$_GET['q'].'%')
                                    ->get();
        } else {
            $peserta = Peserta::where('id_tahun_ajar', $tahunAktif->id_tahun_ajar)->get();
        }

        // $peserta = Peserta::first();

        // dd($peserta->count());

        return view('asesor.penilaian.index', compact('peserta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $peserta = Peserta::findOrFail($id);

        return view('asesor.penilaian.create', compact('peserta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // Insert ke table penilaian
        $penilaian = Penilaian::create([
            'id_asesor'     => Auth::user()->asesor->id_asesor,
            'id_peserta'    => ''.$id.'',
            'paket_soal'    => $request['paket_soal']
        ]);

        return redirect(route('asesor.detail-penilaian.create', $penilaian->id_penilaian));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penilaian = Penilaian::where('id_peserta', $id)->first();

        $penilaian->delete();

        return redirect()->back()->with('notification', 'Action Completed');
    }

    public function exportView() {

        $penilaian = Penilaian::join('detail_penilaian', 'detail_penilaian.id_penilaian', 'penilaian.id_penilaian')->get();

        if($penilaian->count() <= 0) {
            return redirect(route('asesor.penilaian.index'))->with('notification', 'Tidak ada penilaian');
        }


        $komponenUtama = Komponen::where('parent_komponen', null)->get();

        $tahunAktif = TahunAktif::first();

        // dd($penilaian);

        $arrPenilaian = [];

        $pesertaDinilai = Peserta::join('penilaian', 'peserta.id_peserta', 'penilaian.id_peserta')->get();

        foreach ($pesertaDinilai as $keyPeserta => $peserta) {
            foreach ($komponenUtama as $key => $komponen) {

                if($komponen->detaiPenilaian) {
                    $arrPenilaian[$keyPeserta][$komponen->id_komponen][] = $penilaian->where('id_komponen', $komponen->id_komponen)
                                                                        ->where('id_peserta', $peserta->id_peserta)
                                                                        ->first()['skor'];
                } else {
                    $subKomponen = Komponen::where('parent_komponen', $komponen->id_komponen)->get();

                    foreach ($subKomponen as $key2 => $subKom) {
                        if($subKom->detailPenilaian->count() > 0) {
                            $arrPenilaian[$keyPeserta][$komponen->id_komponen][] = Penilaian::join('detail_penilaian', 'detail_penilaian.id_penilaian', 'penilaian.id_penilaian')->where('id_komponen', $subKom->id_komponen)
                                    ->where('id_peserta', $peserta->id_peserta)
                                    ->first()['skor'];
                        } else {

                            $subSubKomponen = Komponen::where('parent_komponen', $subKom->id_komponen)->get();

                            foreach ($subSubKomponen as $key3 => $subSubKom) {
                                if($subSubKom->detailPenilaian->count() > 0) {
                                    $arrPenilaian[$keyPeserta][$komponen->id_komponen][] = Penilaian::join('detail_penilaian', 'detail_penilaian.id_penilaian', 'penilaian.id_penilaian')->where('id_komponen', $subSubKom->id_komponen)
                                            ->where('id_peserta', $peserta->id_peserta)
                                            ->first()['skor'];
                                }
                            }

                        }
                    }
                }
            }
        }


        // dd($arrPenilaian);

        // Menambahkan id dan nama peserta ke array
        foreach ($pesertaDinilai as $key => $peserta) {
            $arrNilai[$key]['id_peserta'] = $peserta->id_peserta;
            $arrNilai[$key]['nama'] = $peserta->nama;
        }

        // Menambahkan skor per komponen utama ke array
        foreach ($arrPenilaian as $key => $komponen) {
            // $arrNilai[$key] = array_sum($komponen);

            foreach($komponen as $key2 => $sub) {

                // Menghitung nilai komponen
                $skor_perolehan = array_sum($sub);
                $skor_maksimal = DetailKomponen::where('id_komponen', $key2)->first()['skor_maksimal'];
                $bobot = DetailKomponen::where('id_komponen', $key2)->first()['bobot'];

                $arrNilai[$key]['nilai'][] = $this->nilaiAkhir($skor_perolehan, $skor_maksimal, $bobot);

            }
        }

        // menambahkan total skor ke array
        foreach ($arrNilai as $key => $komponen) {
            $arrNilai[$key]['total'] = array_sum($komponen['nilai']);
        }

        // dd($arrNilai);

        return view('admin.penilaian.export', compact('tahunAktif', 'komponenUtama', 'arr', 'arrNilai'));
    }

    // Function untuk rumus nilai komponen
    public function nilaiAkhir($skor_perolehan, $skor_maksimal, $bobot) {
        $nilai_komponen = $skor_perolehan / $skor_maksimal * $bobot;

        return $nilai_komponen;
    }

}
