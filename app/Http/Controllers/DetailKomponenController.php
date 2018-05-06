<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DetailKomponen;

class DetailKomponenController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DetailKomponen::create([
            'id_komponen' => $request['id_komponen'],
            'skor_maksimal' => $request['skor_maksimal'],
            'bobot' => $request['bobot'],
        ]);

        return redirect()->back()->with('notification', 'Action completed');
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
        // dd(DetailKomponen::find($id));

        DetailKomponen::findOrFail($id)->update([
            'skor_maksimal' => $request['skor_maksimal'],
            'bobot' => $request['bobot']
        ]);

        return redirect()->back()->with('notification', 'Action completed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
