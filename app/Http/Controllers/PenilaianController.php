<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TahunAktif;
use App\Peserta;
use App\Asesor;
use App\Penilaian;
use App\DetailPenilaian;
use App\Komponen;
use App\DetailKomponen;

use App\Jurusan;
use App\JurusanAktif;

use Auth;

use PHPExcel_Worksheet_Drawing;

// Untuk Pagination
use Illuminate\Pagination\LengthAwarePaginator;

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
        $idJurusanAktif = JurusanAktif::first()['id_jurusan'];
        $tahunAktif = TahunAktif::first();

        if(Auth::user()->akses == 'administrator') {
            $jurusanAktif = Jurusan::where('id_jurusan', $idJurusanAktif)->first();

            if(isset($_GET['q'])) {
                $peserta = Peserta::join('kelas', 'peserta.id_kelas', 'kelas.id_kelas')
                                ->where('id_jurusan', $idJurusanAktif)
                                ->where('id_tahun_ajar', $tahunAktif->id_tahun_ajar)
                                ->where('nama', 'LIKE', '%'.$_GET['q'].'%')
                                ->paginate(15);
            } else {
                $peserta = Peserta::join('kelas', 'peserta.id_kelas', 'kelas.id_kelas')
                                ->where('id_jurusan', $idJurusanAktif)
                                ->where('id_tahun_ajar', $tahunAktif->id_tahun_ajar)->paginate(15);
            }

        } elseif(Auth::user()->akses == 'asesor') { // Kalau asesor, peserta yang ditampilkan berdasarkan jurusan asesor
            $asesor = Asesor::where('id_user', Auth::user()->id_user)->first();
            $jurusanAktif = Jurusan::where('id_jurusan', $asesor->id_jurusan)->first();

            // return $asesor->id_jurusan;

            if(isset($_GET['q'])) {
                $peserta = Peserta::join('kelas', 'peserta.id_kelas', 'kelas.id_kelas')
                                ->where('id_jurusan', $asesor->id_jurusan)
                                ->where('id_tahun_ajar', $tahunAktif->id_tahun_ajar)
                                ->where('nama', 'LIKE', '%'.$_GET['q'].'%')
                                ->paginate(15);
            } else {
                $peserta = Peserta::join('kelas', 'peserta.id_kelas', 'kelas.id_kelas')
                                ->where('id_jurusan', $asesor->id_jurusan)
                                ->where('id_tahun_ajar', $tahunAktif->id_tahun_ajar)->paginate(15);
            }
        }

        // $peserta = Peserta::first();

        // dd($peserta->count());

        return view('asesor.penilaian.index', compact('peserta', 'jurusanAktif'));
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
    	$tipe_ukk = Auth::user()->asesor->perusahaan->tipe_perusahaan == 'internal' ? 'pra ukk' : 'real ukk';

    	// dd($tipe_ukk);

        // Insert ke table penilaian
        $penilaian = Penilaian::create([
            'id_asesor'     => Auth::user()->asesor->id_asesor,
            'id_peserta'    => ''.$id.'',
            'paket_soal'    => $request['paket_soal'],
            'tipe_ukk' 		=> $tipe_ukk
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
    	$tipe_ukk = Auth::user()->asesor->perusahaan->tipe_perusahaan == 'internal' ? 'pra ukk' : 'real ukk';
        $penilaian = Penilaian::where('id_peserta', $id)
        				->where('tipe_ukk', $tipe_ukk)
        				->first();

        $penilaian->delete();

        return redirect()->back()->with('notification', 'Action Completed');
    }


    // Memproses semua nilai akhir
    public function exportData($tipe_ukk = 'pra ukk') {

        $idJurusanAktif = JurusanAktif::first()['id_jurusan'];

        // dd($idJurusanAktif);
        $komponenUtama = Komponen::where('parent_komponen', null)->where('id_jurusan', $idJurusanAktif)->get();


        $penilaian = Penilaian::join('detail_penilaian', 'detail_penilaian.id_penilaian', 'penilaian.id_penilaian')
                        ->join('peserta', 'penilaian.id_peserta', 'peserta.id_peserta')
                        ->join('kelas', 'peserta.id_kelas', 'kelas.id_kelas')
                        ->where('id_jurusan', $idJurusanAktif)
                        ->where('peserta.id_tahun_ajar', TahunAktif::first()['id_tahun_ajar'])
                        ->where('penilaian.tipe_ukk', $tipe_ukk)
                        // ->where('peserta.nama', 'LIKE', '%'.$data_peserta.'%')
                        // ->orWhere('peserta.id_peserta', 'LIKE', '%'.$data_peserta.'%')
                        ->get();

        // dd($penilaian);

        if($penilaian->count() === 0) {
            return 0;
            // return back()->with('notification', 'Tidak ada penilaian');
        }


        // dd($penilaian);

        $arrPenilaian = [];

        $pesertaDinilai = Peserta::join('penilaian', 'peserta.id_peserta', 'penilaian.id_peserta')
                            ->join('kelas', 'peserta.id_kelas', 'kelas.id_kelas')
                            ->where('id_jurusan', $idJurusanAktif)
                            ->where('peserta.id_tahun_ajar', TahunAktif::first()['id_tahun_ajar'])
                            ->where('penilaian.tipe_ukk', $tipe_ukk)
                            ->get();

        foreach ($pesertaDinilai as $keyPeserta => $peserta) {
            foreach ($komponenUtama as $key => $komponen) {

                if($komponen->detaiPenilaian) {
                    $arrPenilaian[$keyPeserta][$komponen->id_komponen][] = $penilaian->where('id_komponen', $komponen->id_komponen)
                                                                        ->where('id_peserta', $peserta->id_peserta)
                                                                        ->where('penilaian.tipe_ukk', $tipe_ukk)
                                                                        ->first()['skor'];
                } else {
                    $subKomponen = Komponen::where('parent_komponen', $komponen->id_komponen)->get();

                    foreach ($subKomponen as $key2 => $subKom) {
                        if($subKom->detailPenilaian->count() > 0) {
                            $arrPenilaian[$keyPeserta][$komponen->id_komponen][] = Penilaian::join('detail_penilaian', 'detail_penilaian.id_penilaian', 'penilaian.id_penilaian')->where('id_komponen', $subKom->id_komponen)
                                    ->where('id_peserta', $peserta->id_peserta)
                                    ->where('penilaian.tipe_ukk', $tipe_ukk)
                                    ->first()['skor'];
                        } else {

                            $subSubKomponen = Komponen::where('parent_komponen', $subKom->id_komponen)->get();

                            foreach ($subSubKomponen as $key3 => $subSubKom) {
                                if($subSubKom->detailPenilaian->count() > 0) {
                                    $arrPenilaian[$keyPeserta][$komponen->id_komponen][$key2][] = Penilaian::join('detail_penilaian', 'detail_penilaian.id_penilaian', 'penilaian.id_penilaian')->where('id_komponen', $subSubKom->id_komponen)
                                            ->where('id_peserta', $peserta->id_peserta)
                                            ->where('penilaian.tipe_ukk', $tipe_ukk)
                                            ->first()['skor'];
                                }
                            }

                        }
                    }
                }
            }
        }


        // dd($arrPenilaian);

        // return $arrPenilaian;

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

                if (count($sub) == count($sub, COUNT_RECURSIVE)) 
                {
                    // Jika tidak ada sub sub komponen
                    $skor_perolehan = array_sum($sub);
                }
                else // Jika ada sub sub komponen
                {
                    $skor_perolehan = 0;
                    foreach($sub as $k => $val) {
                        $skor_perolehan += array_sum( (array) $val) / ( @count($val) < 1 ? 1 : @count($val) );
                    }
                }

                
                $skor_maksimal = DetailKomponen::where('id_komponen', $key2)->first()['skor_maksimal'];
                $bobot = DetailKomponen::where('id_komponen', $key2)->first()['bobot'];

                $arrNilai[$key]['nilai'][] = $this->nilaiAkhir($skor_perolehan, $skor_maksimal, $bobot);

            }
        }

        // menambahkan total skor ke array
        foreach ($arrNilai as $key => $komponen) {
            $arrNilai[$key]['total'] = array_sum($komponen['nilai']);
        }

        // echo ($arrNilai);

        // return view('admin.penilaian.export', compact('tahunAktif', 'komponenUtama', 'arr', 'arrNilai'));
        // dd($arrNilai);
        return $arrNilai;

    }

    public function exportView() {
        $idJurusanAktif = JurusanAktif::first()['id_jurusan'];
        $komponenUtama = Komponen::where('parent_komponen', null)->where('id_jurusan', $idJurusanAktif)->get();

        $tahunAktif = TahunAktif::first();

        // dd($tahunAktif);

        // if(isset($_GET['q']) && $_GET['q'] != '') {
            // return $_GET['q'];
            // $arrNilai = $this->exportData($_GET['q']);
        // } else {
            // $arrNilai = $this->exportData();
        // }
        
        $arrNilai = $this->exportData();

        // dd($arrNilai);

        if($arrNilai === 0) {
            return back()->with('notification', 'Tidak ada penilaian');
        }

        // Mengubah integer 0 ke string 0
        // foreach ($arrNilai as $key => $value) {
        //     foreach($value['nilai'] as $Key2 => $nilai) {
        //         if($nilai == 0) {
        //             $nilai = (float) $nilai;
        //         }
        //     }
        // }

        // paginate hasil
        $arrNilai = $this->paginateArray($arrNilai, 5);

        return view('admin.penilaian.export', compact('tahunAktif', 'komponenUtama', 'arrNilai'));
    }

    public function exportViewRealUkk() {
        $idJurusanAktif = JurusanAktif::first()['id_jurusan'];
        $komponenUtama = Komponen::where('parent_komponen', null)->where('id_jurusan', $idJurusanAktif)->get();

        $tahunAktif = TahunAktif::first();

        // dd($tahunAktif);

        // if(isset($_GET['q']) && $_GET['q'] != '') {
            // return $_GET['q'];
            // $arrNilai = $this->exportData($_GET['q']);
        // } else {
            // $arrNilai = $this->exportData();
        // }
        
        $arrNilai = $this->exportData('real ukk');

        // dd($arrNilai);

        if($arrNilai === 0) {
            return back()->with('notification', 'Tidak ada penilaian');
        }

        // Mengubah integer 0 ke string 0
        // foreach ($arrNilai as $key => $value) {
        //     foreach($value['nilai'] as $Key2 => $nilai) {
        //         if($nilai == 0) {
        //             $nilai = (float) $nilai;
        //         }
        //     }
        // }

        // paginate hasil
        $arrNilai = $this->paginateArray($arrNilai, 5);

        return view('admin.penilaian.export', compact('tahunAktif', 'komponenUtama', 'arrNilai'));
    }

    // Function untuk rumus nilai komponen
    public function nilaiAkhir($skor_perolehan, $skor_maksimal, $bobot) {
        $nilai_komponen = $skor_perolehan / $skor_maksimal * $bobot;

        return $nilai_komponen;
    }


    // Export ke excel

    public function exportRealUkk() {
        $this->export('real ukk');
    }


    public function export($tipe_ukk = 'pra ukk') {

        \Excel::create('PENILAIAN_UJIAN_PRAKTIK_KEJURUAN_'.date('d_m_Y'), function($excel) use ($tipe_ukk) {
            $arrNilai = $this->exportData($tipe_ukk);

            // Konversi array multi dimensi ke satu dimensi
            foreach($arrNilai as $key => $peserta) {
                // $peserta = array_flatten($peserta);
                $arrNilai[$key] = array_flatten($peserta);

                // dd($peserta);
            }

            $tahunAjar = TahunAktif::first()->tahunAjar->tahun_ajar;
            $idJurusanAktif = JurusanAktif::first()['id_jurusan'];
            // dd($tahunAjar);

            $judul = 'Lembar penilaian ujian praktik keujuruan untuk uji kompetensi keahlian';

            $excel->setDescription($judul.' '.$tahunAjar);
            $excel->sheet('Penilaian', function($sheet) use ($arrNilai, $judul, $tahunAjar, $idJurusanAktif) {
                $sheet->fromArray($arrNilai, null, 'A7', false, false);

                $headings = array('Nomor Peserta', 'Nama');

                $komponenUtama = Komponen::where('parent_komponen', null)
                                    ->where('id_jurusan', $idJurusanAktif)
                                    ->get();

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

    public function sumArray($array) {
        return array_sum($array);
    }

    // Untuk pagination array
    public function paginateArray(Array $collection, $page) {
        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Create a new Laravel collection from the array data
        $itemCollection = collect($collection);
        // Define how many items we want to be visible in each page
        $perPage = $page;
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        // set url path for generted links
        $paginatedItems->setPath(url()->current());

        return $paginatedItems;
    }

}
