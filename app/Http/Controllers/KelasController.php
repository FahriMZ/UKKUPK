<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kelas;
use App\Jurusan;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['q'])) {
            $kelas = Kelas::where('nama_kelas', 'LIKE', '%'.$_GET['q'].'%')->paginate(11);
        }else{
            $kelas = Kelas::paginate(11);
        }

        return view('admin.kelas.index', compact('kelas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        return view('admin.kelas.create', compact('jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Kelas::create($request->all(), [
            'nama_kelas'    => $request->nama_kelas,
            'id_jurusan'    => $request->id_jurusan
        ]);

        return redirect(route('admin.kelas.index'))->with('notification', 'Action Completed');
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
        $kelas = Kelas::findOrFail($id);
        $jurusan = Jurusan::all();

        return view('admin.kelas.edit', compact('kelas', 'jurusan'));
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
        Kelas::findOrFail($id)->update($request->all(), [
            'nama_kelas'    => $request->nama_kelas,
            'id_jurusan'    => $request->id_jurusan
        ]);

        return redirect(route('admin.kelas.index'))->with('notification', 'Action Completed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kelas::findOrFail($id)->delete();

        return redirect(route('admin.kelas.index'))->with('notification', 'Action Completed');
    }
}
