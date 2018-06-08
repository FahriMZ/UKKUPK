<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jurusan;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['q'])) {
            $jurusan = Jurusan::where('nama_jurusan', 'LIKE', '%'.$_GET['q'].'%')->paginate(11);
        } else {
            $jurusan = Jurusan::paginate(11);
        }

        return view('admin.jurusan.index', compact('jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jurusan.create');
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
        Jurusan::create($request->all(), [
            'nama_jurusan'          => $request->nama_jurusan,
            'deskripsi_jurusan'     => $request->deskripsi_jurusan
        ]);

        return redirect(route('admin.jurusan.index'))->with('notification', 'Action Completed');
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
        $jurusan = Jurusan::findOrFail($id);
        return view('admin.jurusan.edit', compact('jurusan'));
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
        Jurusan::findOrFail($id)->update($request->all(), [
            'nama_jurusan'          => $request->nama_jurusan,
            'deskripsi_jurusan'     => $request->deskripsi_jurusan
        ]);

        return redirect(route('admin.jurusan.index'))->with('notification', 'Action Completed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jurusan::findOrFail($id)->delete();
        return redirect(route('admin.jurusan.index'))->with('notification', 'Action Completed');
    }
}
