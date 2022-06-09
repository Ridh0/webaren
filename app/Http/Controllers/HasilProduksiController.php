<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilProduksi;
use App\Models\Produksi;
use Illuminate\Support\Facades\Validator;

class HasilProduksiController extends Controller
{
    public function index()
    {
        $produksii = HasilProduksi::with('produksi')->get();
        return view('produksi.hasil', compact('produksii'));
    }
    public function tambah()
    {
        $produksi = Produksi::all();
        return view('produksi.tambahhasil', compact('produksi'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'produksi_id' => 'required',
            'ar5' =>  'nullable|integer',
            'ar1' => 'nullable|integer',
            'ar25' => 'nullable|integer',
            'rg25' => 'nullable|integer',
            'rg5' => 'nullable|integer',
            'rg1' => 'nullable|integer',
            'rgk1' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            HasilProduksi::create($request->all());
            return back()->withStatus(__('Inventori successfully updated.'));
        };
    }
}
