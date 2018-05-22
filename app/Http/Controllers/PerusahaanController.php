<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Perusahaan;

class PerusahaanController extends Controller
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
            $perusahaan = Perusahaan::where('nama_perusahaan', 'LIKE', '%'.$_GET['q'].'%')->paginate(11);
        } else {
            $perusahaan = Perusahaan::paginate(11);
        }
        
        return view('admin.perusahaan.index', compact('perusahaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perusahaan = Perusahaan::all();
        return view('admin.perusahaan.create', compact('perusahaan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        Perusahaan::create([

            'nama_perusahaan'       => $request->nama_perusahaan,
            'alamat_perusahaan'     => $request->alamat_perusahaan,
            'direktur_perusahaan'   => $request->direktur_perusahaan,
            'tipe_perusahaan'       => $request->tipe_perusahaan == 'on' ? 'internal' : 'eksternal'

        ]);


        return redirect(route('admin.perusahaan.index'))->with('notification', 'Action Completed');
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
        $perusahaan = Perusahaan::findOrFail($id);
        return view('admin.perusahaan.edit', compact('perusahaan'));
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
        Perusahaan::findOrFail($id)->update([

            'nama_perusahaan'       => $request->nama_perusahaan,
            'alamat_perusahaan'     => $request->alamat_perusahaan,
            'direktur_perusahaan'   => $request->direktur_perusahaan,
            'tipe_perusahaan'       => $request->tipe_perusahaan == 'on' ? 'internal' : 'eksternal'

        ]);

        return redirect(route('admin.perusahaan.index'))->with('notification', 'Action Completed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);

        if($perusahaan->asesor->count() > 0) {
            return redirect()->back()->with('notification', 'Data is used by another process');
        }

        $perusahaan->delete();
        return redirect(route('admin.perusahaan.index'))->with('notification', 'Action Completed');
    }
}
