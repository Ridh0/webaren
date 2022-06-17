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
            'nwo' => 'nullable',
            'ar5' =>  'nullable|integer',
            'ar1' => 'nullable|integer',
            'ar25' => 'nullable|integer',
            'rg25' => 'nullable|integer',
            'rg5' => 'nullable|integer',
            'rg1' => 'nullable|integer',
            'rgk1' => 'nullable|integer',
        ]);
        $ar5 = $request->ar5 / 2;
        $ar25 = $request->ar25 / 4;
        $ar1 = $request->ar1;
        $rg5 = $request->rg5 / 2;
        $rg25 = $request->rg25 / 4;
        $rg1 = $request->rg1;
        $rgk1 = $request->rgk1;
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            HasilProduksi::create(
                [
                    'produksi_id' => $request->produksi_id,
                    'ar5' => $ar5,
                    'ar25' => $ar25,
                    'rg25' => $rg25,
                    'rg5' => $rg5,
                    'rg1' => $rg1,
                    'rg1' => $rg1,
                    'rgk1' => $rgk1,
                    'jmlhasil' => $ar5 + $ar25 + $rg25 + $rg5 + $rg1 + $rgk1,
                ]
            );
            return back()->withStatus(__('Inventori successfully updated.'));
        };
    }
}
