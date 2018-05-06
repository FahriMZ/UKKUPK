<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

use App\DokumenAsesor;
use App\Asesor;
use Auth;

class DokumenAsesorController extends Controller
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

        $this->repairStorage();

        $asesor = Asesor::where('id_user', Auth::user()->id_user)->first();

        if(isset($_GET['q'])) {
            $dokumen_asesor = DokumenAsesor::where('id_asesor', $asesor->id_asesor)
                                ->where('nama_dokumen', 'LIKE', '%'.$_GET['q'].'%')
                                ->paginate(6);
        } else {
            $dokumen_asesor = DokumenAsesor::where('id_asesor', $asesor->id_asesor)->paginate(6);
        }


        return view('asesor.dokumen-asesor.index', compact('dokumen_asesor', 'asesor'));
    }

    // Cek apakah database sync dengan storage
    // Membersihkan database jika file tidak ada di storage
    public function repairStorage() {
        // $dokumenAsesor = DokumenAsesor::all();

        // foreach($dokumenAsesor as $dokumen) {
        //     $s = Storage::get('public/dokumen_asesor/'.$dokumen->nama_dokumen) ? true : false ;

        //     if($s) {
        //         $this->destroy($dokumen->id_dokumen);
        //     }
        // }

        // return redirect()->back()->with('notification', 'Data ada');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'nama_dokumen' => 'required|file|mimes:pdf,doc,docx,odp,ods,odt,jpg,jpeg,png',
        ]);

        // Store file to disk
        $file = $request->file('nama_dokumen');
        $nama_file = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $ekstensi_file = $file->getClientOriginalExtension();
        
        $nama_file .= '_'.time().'.'.$ekstensi_file;

        // dd($nama_file);

        $path = Storage::putFileAs(
            'public/dokumen_asesor', $file, $nama_file
        );

        // Store file to database

        DokumenAsesor::create([
            'nama_dokumen'      => $nama_file,
            'id_asesor'         => $id
        ]);

        return redirect()->back()->with('notification', 'Action Completed');
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
        $dokumen = DokumenAsesor::findOrFail($id);
        
        $file = Storage::get('public/dokumen_asesor/'.$dokumen->nama_dokumen);
        
        $dokumen->delete();
        Storage::delete('public/dokumen_asesor/'.$dokumen->nama_dokumen);

        return redirect()->back()->with('notification', 'Action Completed');
    }
}
