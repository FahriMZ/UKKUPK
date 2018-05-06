<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Komponen;
use App\Indikator;

class IndikatorController extends Controller
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
    public function create($id)
    {
        $komponen = Komponen::findOrFail($id);
        return view('admin.indikator.create', compact('komponen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        Indikator::create([
            'id_komponen'   => $id,
            'indikator'     => $request['indikator'],
            'standar_skor'     => $request['standar_skor']
        ]);

        return redirect(route('admin.komponen.show', $id))->with('notification', 'Action completed');
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
        $indikator = Indikator::findOrFail($id);
        return view('admin.indikator.edit', compact('indikator'));
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
        $indikator = Indikator::findOrFail($id);

        $indikator->update([
            'indikator'     => $request['indikator'],
            'standar_skor'     => $request['standar_skor']
        ]);

        return redirect(route('admin.komponen.show', $indikator->id_komponen))->with('notification', 'Action completed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Indikator::findOrFail($id)->delete();

        return redirect()->back()->with('notification', 'Action completed');
    }
}
