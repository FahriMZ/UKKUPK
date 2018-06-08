<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Peserta;
use App\TahunAjar;
use App\TahunAktif;
use App\Kelas;

use Excel;

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
        $kelas = Kelas::all();
        return view('admin.peserta.create', compact('tahunAjar', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        // dd($data->all());

        Peserta::create([
            'id_peserta'        => $data['id_peserta'],
            'nama'              => $data['nama'],
            'jenis_kelamin'     => $data['jenis_kelamin'],
            'tanggal_lahir'     => $data['tanggal_lahir'],
            'alamat'            => $data['alamat'],
            'kontak'            => $data['kontak'],
            'email'             => $data['email'],
            'id_kelas'     => $data['id_kelas'],
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
        $kelas = Kelas::all();
        return view('admin.peserta.edit', compact('peserta', 'tahunAjar', 'kelas'));
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
            'id_kelas'             => $data['id_kelas'],
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

    public function importView() {

        return view('admin.peserta.import');

    }

    public function import(Request $request) {

        // return $request->hasFile('import_file') ? 'true' : 'false';

        if($request->hasFile('import_file')){
            $path = $request->file('import_file')->getRealPath();
            $data = Excel::load($path)->get();

            if($data->count()){
                foreach ($data as $key => $value) {

                    // Validasi
                    $id_tahun_ajar = TahunAjar::where('tahun_ajar', $value->tahun_ajar)->first()['id_tahun_ajar'] ?: null;

                    // return $id_tahun_ajar;

                    if($id_tahun_ajar == null) {

                        return back()->with('notification', 'Tahun ajar <h3 class="text-danger">'.$value->tahun_ajar.'</h3> tidak terdaftar');

                    }


                    $peserta[] = [

                        'id_peserta'        => $value->id_peserta,
                        'nama'              => $value->nama,
                        'alamat'            => $value->alamat,
                        'tanggal_lahir'     => date('Y-m-d', strtotime($value->tanggal_lahir)),
                        'jenis_kelamin'     => $value->jenis_kelamin,
                        'email'             => $value->email,
                        'kontak'            => $value->kontak,
                        'id_tahun_ajar'     => $id_tahun_ajar,

                    ];
                }

                // Mengambil semua id peserta & handle duplikat
                if(Peserta::get()->count() > 0) {

                    $daftar_id = Peserta::get(['id_peserta']);
                
                    // Menyimpan nya ke array
                    foreach($daftar_id as $key => $daftar) {
                        $id_peserta[$key] = $daftar->id_peserta;
                    }

                    // Handle id yang sudah ada
                    foreach($peserta as $s) {
                        if(in_array($s['id_peserta'], $id_peserta) ) {
                            return redirect()->back()->with('notification', "ID ".$s['id_peserta']." sudah terdaftar!");
                        }
                    }

                }

                if(!empty($peserta)){

                    if(count($peserta) > $data->count()) {
                        $dataCount = $data->count(); // Jumlah data asli
                        $emptyCount = count($peserta); // Jumlah data keseluruhan (plus empty row)

                        // return $dataCount;
                        for($x = $dataCount; $x <= $emptyCount; $x++) {
                            unset($peserta[$x]); // Menghapus row kosong
                        }
                    }

                    \DB::table('peserta')->insert($peserta);

                    // return 'hai';
                    return redirect()->back()->with('notification', 'Import data berhasil dilakukan');
                }
            }
        }
    }
}
