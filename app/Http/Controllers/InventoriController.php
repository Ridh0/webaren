<?php

namespace App\Http\Controllers;

use App\Models\Inventori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventori = Inventori::all();
        return view('inventori.index', compact('inventori'));
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
    public function tambahbs(){

        return view('inventori.bs');
    }
    public function bs(Request $request)
    {
        $this->validate($request,[
            'bs' => 'required',
            ]);
        $ecatalogs=Inventori::where('name','rbs')->get();
       foreach($ecatalogs as $row){
        $databs = $row->id;
        $jumlah = $row->jumlah + $request->bs;
        $ecatalog= Inventori::find($databs);
        $ecatalog->update([
            'jumlah' =>$jumlah,
           ]);
       }

        return back()->with('success',"Bs has been updated");
    }
    public function bkeluar()
    {
        $inventori = DB::table('inventori_keluar_masuk')->get();
        
        return view('inventori.bkeluar', compact('inventori'));
    }
    public function bmasuk()
    {
        $inventori = DB::table('inventori_keluar_masuk')->get();
        
        return view('inventori.bmasuk', compact('inventori'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventori  $inventori
     * @return \Illuminate\Http\Response
     */
    public function show(Inventori $inventori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventori  $inventori
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventori $inventori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventori  $inventori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventori $inventori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventori  $inventori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventori $inventori)
    {
        //
    }
}
