<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Komponen;
use App\DetailKomponen;
use App\Indikator;

class KomponenController extends Controller
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
        $komponenUtama = Komponen::where('parent_komponen', null)->paginate(5);

        if(isset($_GET['q'])) {
            $komponen = Komponen::where('komponen', 'LIKE', '%'.$_GET['q'].'%')
                            ->where('parent_komponen', null)->paginate(1);
        } else {
            $komponen = Komponen::where('parent_komponen', null)->paginate(1);
        }
        // $komponen = Komponen::where('parent_komponen', null)->get();
        // $s = Komponen::find(1);

        // return response()->json($komponenUtama);

        return view('admin.komponen.index', compact('komponenUtama', 'komponen'));
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
        Komponen::create([
            'komponen'  => $request['komponen'],
            'parent_komponen'  => $request['parent_komponen'] == null ? null : $request['parent_komponen'],
        ]);

        return redirect()->back()->with('notification', 'Action completed');
    }

    // Menyalin komponen yang sudah ada
    public function storeCopy(Request $request)
    {

        Komponen::create([
            'komponen'  => $request['komponen'],
            'parent_komponen'  => $request['parent_komponen'] == null ? null : $request['parent_komponen'],
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
        $semuaKomponen = Komponen::all();
        $komponen = Komponen::findOrFail($id);

        // dd($komponen);
        // return count($komponen->indikator);

        return view('admin.komponen.show', compact('komponen', 'semuaKomponen'));
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
        // dd($request->all());

        Komponen::findOrFail($id)->update([
            'komponen' => $request['komponen'],
            'parent_komponen' => $request['parent_komponen']
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
        // $komponen = Komponen::findOrFail($id);
        $komponen = Komponen::findOrFail($id);

        if($komponen->detailPenilaian->count() > 0 || $komponen->children->count() > 0) {
            return redirect(route('admin.komponen.index'))->with('notification', 'Action failed');
        }

        $komponen->delete();
        return redirect(route('admin.komponen.index'))->with('notification', 'Action completed');
    }
}
