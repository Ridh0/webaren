<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distributor;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class DistributorController extends Controller
{
    public function index()
    {
        $distributor = Distributor::all();
        return view('distributor.index', compact('distributor'));
    }
    
    public function create()
    {
        $distributor = Distributor::all();
        return view('distributor.create', compact('distributor'));
    }

    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
     
        ]);
       
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            Distributor::create(
                [
                    'nama' => $request->nama,
                  
                ]
            );
            Alert::success('Berhasil', 'Berhasil Menghapus Data !');
            return back()->withStatus(__('Distributor successfully updated.'));
        };

    }

}
