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

use PHPExcel_Worksheet_Drawing;

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


    // Memproses semua nilai akhir
    public function exportData() {

        $komponenUtama = Komponen::where('parent_komponen', null)->get();


        $penilaian = Penilaian::join('detail_penilaian', 'detail_penilaian.id_penilaian', 'penilaian.id_penilaian')
                        ->join('peserta', 'penilaian.id_peserta', 'peserta.id_peserta')
                        ->where('peserta.id_tahun_ajar', TahunAktif::first()['id_tahun_ajar'])
                        ->get();

        // dd($penilaian);

        if($penilaian->count() <= 0) {
            return redirect(route('asesor.penilaian.index'))->with('notification', 'Tidak ada penilaian');
        }


        // dd($penilaian);

        $arrPenilaian = [];

        $pesertaDinilai = Peserta::join('penilaian', 'peserta.id_peserta', 'penilaian.id_peserta')
                            ->where('peserta.id_tahun_ajar', TahunAktif::first()['id_tahun_ajar'])
                            ->get();

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

        // return view('admin.penilaian.export', compact('tahunAktif', 'komponenUtama', 'arr', 'arrNilai'));

        return $arrNilai;

    }

    public function exportView() {
        $komponenUtama = Komponen::where('parent_komponen', null)->get();

        $tahunAktif = TahunAktif::first();

        $arrNilai = $this->exportData();

        return view('admin.penilaian.export', compact('tahunAktif', 'komponenUtama', 'arrNilai'));
    }

    // Function untuk rumus nilai komponen
    public function nilaiAkhir($skor_perolehan, $skor_maksimal, $bobot) {
        $nilai_komponen = $skor_perolehan / $skor_maksimal * $bobot;

        return $nilai_komponen;
    }


    // Export ke excel
    public function export() {

        \Excel::create('PENILAIAN_UJIAN_PRAKTIK_KEJURUAN_'.date('d_m_Y'), function($excel) {

            $arrNilai = $this->exportData();

            // Konversi array multi dimensi ke satu dimensi
            foreach($arrNilai as $key => $peserta) {
                // $peserta = array_flatten($peserta);
                $arrNilai[$key] = array_flatten($peserta);

                // dd($peserta);
            }

            $tahunAjar = TahunAktif::first()->tahunAjar->tahun_ajar;

            // dd($tahunAjar);

            $judul = 'Lembar penilaian ujian praktik keujuruan untuk uji kompetensi keahlian';

            $excel->setDescription($judul.' '.$tahunAjar);
            $excel->sheet('Penilaian', function($sheet) use ($arrNilai, $judul, $tahunAjar) {
                $sheet->fromArray($arrNilai, null, 'A7', false, false);

                $headings = array('Nomor Peserta', 'Nama');

                $komponenUtama = Komponen::where('parent_komponen', null)->get();

                // menambahkan semua komponen ke headings
                foreach ($komponenUtama as $key => $komponen) {
                    $headings[] = $komponen->komponen;
                }

                $headings[] = 'Total NK';


                // $sheet->prependRow(1, array());
                // $sheet->prependRow(2, array());
                $sheet->prependRow(3, array(strtoupper($judul)));
                $sheet->prependRow(4, array('TAHUN PELAJARAN '.$tahunAjar));
                // $sheet->prependRow(5, array());
                $sheet->prependRow(9, $headings);

                // Style
                $sheet->setAutoSize(true);
                $sheet->mergeCells('A3:H3');
                $sheet->mergeCells('A4:H4');
                $sheet->getStyle('A3')->getAlignment()->applyFromArray(
                    array('horizontal' => 'center')
                );
                $sheet->getStyle('A4')->getAlignment()->applyFromArray(
                    array('horizontal' => 'center')
                );
                $sheet->cell('A9:h9', function($cell){
                    $cell->setBorder('thin','thin','thin','thin');
                });

                // Insert gambar ke file

                $objDrawing = new PHPExcel_Worksheet_Drawing;

                $objDrawing->setPath(public_path('image/jabar.png')); // Gambar nya

                // Size
                $objDrawing->setWidthAndHeight(100, 100);

                $objDrawing->setCoordinates('G2'); // Koordinat / penempatan

                $objDrawing->setWorksheet($sheet);

                // Gambar 2
                $objDrawing2 = new PHPExcel_Worksheet_Drawing;

                $objDrawing2->setPath(public_path('image/smkn11.jpeg')); // Gambar nya

                // Size
                $objDrawing2->setWidthAndHeight(100, 100);

                $objDrawing2->setCoordinates('A2'); // Koordinat / penempatan

                $objDrawing2->setWorksheet($sheet);

            });

        })->export('xlsx');

        return back()->with('notification', 'Action completed');

    }

}
