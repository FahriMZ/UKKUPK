<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;

use App\Asesor;
use App\User;
use App\Perusahaan;
use App\Jurusan;

use Auth;

class AsesorController extends Controller
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

        if(isset($_GET['q'])) {

            $asesor = Asesor::where('nama', 'LIKE', '%'.$_GET['q'].'%')->paginate(11);

        } else {

            $asesor = Asesor::paginate(11);
            
        }

        // dd($asesor);

        return view('admin.asesor.index', compact('asesor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perusahaan = Perusahaan::all();

        if($perusahaan->count() == 0 ) {
            return back()->with('notification', 'Daftarkan <span class="text-info">PERUSAHAAN</span> terlebih dahulu !');
        }

        $jurusan = Jurusan::all();

        return view('admin.asesor.create', compact('perusahaan', 'jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {

        dd($data->all());

        // Default akun untuk asesor

        // Default username
        $username = date('dmY', strtotime($data['tanggal_lahir']));
        $username .= '-';
        $username .= Asesor::orderBy('id_asesor', 'desc')->first()['id_asesor']+1;
        $username .= '-';

        $nama_perusahaan = explode(' ', Perusahaan::where('id_perusahaan', $data['id_perusahaan'])->first()['nama_perusahaan']);

        foreach($nama_perusahaan as $perusahaan) {
            $username .= substr($perusahaan, 0, 1);
        }

        // Default password
        $password = Hash::make(123456);


        // $user = User::create([
        //     'username' => $data['username'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        //     'akses' => 'asesor'
        // ]);

        $user = User::create([
            'username' => $username,
            'email' => $data['email'],
            'password' => $password,
            'akses' => 'asesor'
        ]);

        $asesor = Asesor::create([
            'nama'              => $data['nama'],
            'id_user'           => $user->id_user,
            'id_perusahaan'     => $data['id_perusahaan'],
            'jenis_kelamin'     => $data['jenis_kelamin'],
            'tanggal_lahir'     => $data['tanggal_lahir'],
            'alamat'            => $data['alamat'],
            'kontak'            => $data['kontak'],
            'id_jurusan'        => $data['id_jurusan']
        ]);

        if($asesor && $user) {
            return redirect(route('admin.asesor.index'))->with('notification', 'Action completed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $asesor = Asesor::findOrFail($id);

        return view('admin.asesor.show', compact('asesor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asesor = Asesor::findOrFail($id);
        $perusahaan = Perusahaan::all();
        $jurusan = Jurusan::all();
        return view('admin.asesor.edit', compact('asesor', 'perusahaan', 'jurusan'));
    }

    public function editDataSendiri()
    {
        $asesor = Asesor::findOrFail(Auth::user()->asesor->id_asesor);
        $perusahaan = Perusahaan::all();
        $jurusan = Jurusan::all();
        return view('asesor.data-diri.edit', compact('asesor', 'perusahaan', 'jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data, $id)
    {
        $asesor = Asesor::findOrFail($id);


        $asesor->update([
            'nama'              => $data['nama'],
            'id_perusahaan'     => $data['id_perusahaan'],
            'jenis_kelamin'     => $data['jenis_kelamin'],
            'tanggal_lahir'     => $data['tanggal_lahir'],
            'alamat'            => $data['alamat'],
            'kontak'            => $data['kontak'],
            'id_jurusan'        => $data['id_jurusan']
        ]);

        if($data->password == null) {

            $user = User::findOrFail($asesor->id_user)->update([
                'username' => $data['username'],
                'email' => $data['email']
            ]);

        } else {

            $user = User::findOrFail($asesor->id_user)->update([
                'username' => $data['username'],
                'email' => $data['email'],
                'password'  => Hash::make($data['password'])
            ]);

        }

        if($asesor && $user) {
            return back()->with('notification', 'Action completed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asesor = Asesor::findOrFail($id);
        $asesor->delete();
        User::findOrFail($asesor->id_user)->delete();

        return redirect(route('admin.asesor.index'))->with('notification', 'Action completed');
    }
}
