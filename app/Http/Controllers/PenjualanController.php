<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Keuangan;
use App\Models\Distributor;
use App\Models\User;
use App\Models\Inventori;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Jimmyjs\ReportGenerator\Facades\PdfReportFacade;
use Jimmyjs\ReportGenerator\Facades\ExcelReportFacade;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $penjualan = Penjualan::all();
        return view('penjualan.index', compact('penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $distributor = Distributor::all();
        $pembeli = User::all();
        $penjualan = Penjualan::all();
        return view('penjualan.create', compact('penjualan', 'pembeli', 'distributor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'status' => 'required',
        ]);
        Penjualan::create([
            'status' => $request->status,
            'harga' => $request->harga,
            'kode' => $request->kode,
            'distributor_id' => $request->distributor_id,
            'tanggal' => $request->tanggal,
            'nama' => $request->nama,
            'nofaktur' => "F-" . $request->nofaktur1 . "-" . $request->nofaktur2,
            'notagudang' => "G-" . $request->notagudang1 . "-" . $request->notagudang2,
            'harga' => $request->harga,
            'status' => $request->status,
            'gulabatok' => $request->gulabatok,
            'ar25' => $request->ar25,
            'ar5' => $request->ar5,
            'ar1' => $request->ar1,
            'rg25' => $request->rg25,
            'rg5' => $request->rg5,
            'rg1' => $request->rg1,
            'rgk1' => $request->rgk1,
            'gsm' => $request->gsm,
            'cr' => $request->cr,
            'aj' => $request->aj,
            'k' => $request->k,
            'toi' => $request->toi,
        ]);
        Keuangan::create([
            'masuk' => $request->harga,
        ]);
        $ecatalogs = Inventori::where('name', 'ar25')->get();
        foreach ($ecatalogs as $row) {
            $ar25 = $row->id;
            $jumlah = $row->jumlah - $request->ar25;
            $ecatalog = Inventori::find($ar25);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'ar5')->get();
        foreach ($ecatalogs as $row) {
            $ar5 = $row->id;
            $jumlah = $row->jumlah - $request->ar5;
            $ecatalog = Inventori::find($ar5);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'ar1')->get();
        foreach ($ecatalogs as $row) {
            $ar1 = $row->id;
            $jumlah = $row->jumlah - $request->ar1;
            $ecatalog = Inventori::find($ar1);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'rg1')->get();
        foreach ($ecatalogs as $row) {
            $rg1 = $row->id;
            $jumlah = $row->jumlah - $request->rg1;
            $ecatalog = Inventori::find($rg1);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'rg5')->get();
        foreach ($ecatalogs as $row) {
            $rg5 = $row->id;
            $jumlah = $row->jumlah - $request->rg5;
            $ecatalog = Inventori::find($rg5);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'rg25')->get();
        foreach ($ecatalogs as $row) {
            $rg25 = $row->id;
            $jumlah = $row->jumlah - $request->rg25;
            $ecatalog = Inventori::find($rg25);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'rgkotak')->get();
        foreach ($ecatalogs as $row) {
            $rgkotak = $row->id;
            $jumlah = $row->jumlah - $request->rgk1;
            $ecatalog = Inventori::find($rgkotak);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        Alert::success('Berhasil', 'Berhasil Menghapus Data !');

        return back()->with('success', "Data berhasil ditambah");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
        $penjualans = Penjualan::with('user')->where('id', $penjualan->id)->get();
        return view('penjualan.show', compact('penjualans'));
    }
    public function rekap_harian()
    {
        $today = date('Y-m-d');
        $penjualan = DB::table('penjualan')
        ->where('created_at','LIKE','%'.$today.'%')
            ->select(
                'distributor_id',
                DB::raw('count(id)  as id'),
                DB::raw('SUM(aj)  as total_aj'),
                DB::raw('SUM(gulabatok)  as total_gulabatok'),
                DB::raw('SUM(ar25)  as total_ar25'),
                DB::raw('SUM(ar5)  as total_ar5'),
                DB::raw('SUM(ar1)  as total_ar1'),
                DB::raw('SUM(rg5)  as total_rg5'),
                DB::raw('SUM(rg25)  as total_rg25'),
                DB::raw('SUM(rg1)  as total_rg1'),
                DB::raw('SUM(rgk1)  as total_rgk1'),
                DB::raw('SUM(gsm)  as total_gsm'),
                DB::raw('SUM(cr)  as total_cr'),
                DB::raw('SUM(aj)  as total_aj'),
                DB::raw('SUM(k)  as total_k'),
                DB::raw('SUM(toi)  as total_toi'),
            )
            ->groupBy('distributor_id')
            ->get();
        return view('penjualan.rekap', compact('penjualan'));
    }

    public function rekap_bulanan()
    {

        $month = date('y-m');
        $penjualan =  DB::table('penjualan')
        ->where('created_at','LIKE','%'.$month.'%')
            ->select(
                'distributor_id',
                DB::raw('count(id)  as id'),
                DB::raw('SUM(aj)  as total_aj'),
                DB::raw('SUM(gulabatok)  as total_gulabatok'),
                DB::raw('SUM(ar25)  as total_ar25'),
                DB::raw('SUM(ar5)  as total_ar5'),
                DB::raw('SUM(ar1)  as total_ar1'),
                DB::raw('SUM(rg5)  as total_rg5'),
                DB::raw('SUM(rg25)  as total_rg25'),
                DB::raw('SUM(rg1)  as total_rg1'),
                DB::raw('SUM(rgk1)  as total_rgk1'),
                DB::raw('SUM(gsm)  as total_gsm'),
                DB::raw('SUM(cr)  as total_cr'),
                DB::raw('SUM(aj)  as total_aj'),
                DB::raw('SUM(k)  as total_k'),
                DB::raw('SUM(toi)  as total_toi'),
            )
            ->groupBy('distributor_id')
            ->get();
        return view('penjualan.rekap', compact('penjualan'));
    }

    public function displayReport(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = $request->input('sort_by');

        $title = 'Rekapan Perbulan Bagian Penjualan'; // Report title

        $meta = [ // For displaying filters description on header
            'Pada Tanggal' => $fromDate . ' To ' . $toDate,
        ];

        $queryBuilder = Penjualan::select(['user_id', 'aj', 'ar', 'gp', 'gt', 'toi', 'k', 'tjawa', 'created_at']) // Do some querying..
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->orderBy($sortBy);

        $columns = [ // Set Column to be displayed
            'user_id' => 'user_id',
            'Tanggal', // if no column_name specified, this will automatically seach for snake_case of column name (will be created_at) column from query result
            'Total AJ' => 'aj',
            'Total AR' => 'ar',
            'Total GP' => 'gp',
            'Total GT' => 'gt',
            'Total TOI' => 'toi',
            'Total K' => 'k',
            'Total TJAWA' => 'tjawa',

        ];

        // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
        return PdfReportFacade::of($title, $meta, $queryBuilder, $columns)
            ->editColumn('Tanggal', [ // Change column class or manipulate its data for displaying to report
                'displayAs' => function ($result) {
                    return $result->created_at->format('d M y');
                },
                'class' => 'left'
            ])
            ->editColumns(['Total AR', 'Total TOI', 'Total K', 'Total GT', 'Total GP', 'Total TJAWA', 'Total TOI', 'Total AJ'], [ // Mass edit column
                'class' => 'right bold'
            ])
            ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                'Total AR' => 'point',
                'Total AJ' => 'point',
                'Total GP' => 'point',
                'Total GT' => 'point',
                'Total TOI' => 'point',
                'Total K' => 'point',
                'Total TJAWA' => 'point'
                // if you want to show dollar sign ($) then use 'Total Balance' => '$'
            ])
            ->groupBy('user_id')
            ->limit(20) // Limit record to be showed
            ->stream(); // other available method: store('path/to/file.pdf') to save to disk, download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function editbahan(Penjualan $penjualan)
    {
        return view('penjualan.edit-bahan', compact('penjualan'));
    }
    public function updatebahan(Request $request, Penjualan $penjualan)
    {
        $this->validate($request, [
            'aj' => 'required',
        ]);
        if ($request->ar25 != $penjualan->ar25) :

            $ecatalogs = Inventori::where('name', 'ar25')->get();
            foreach ($ecatalogs as $row) {
                $ar25 = $row->id;
                $jumlah = $row->jumlah - $request->ar25;
                $ecatalog = Inventori::find($ar25);
                $ecatalog->update([
                    'jumlah' => $jumlah,
                ]);
            }
        endif;
        if ($request->gsm != $penjualan->gsm) :

            $ecatalogs = Inventori::where('name', 'gsm')->get();
            foreach ($ecatalogs as $row) {
                $gsm = $row->id;
                $jumlah = $row->jumlah - $request->gsm;
                $ecatalog = Inventori::find($gsm);
                $ecatalog->update([
                    'jumlah' => $jumlah,
                ]);
            }
        endif;
        if ($request->aj != $penjualan->aj) :

            $ecatalogs = Inventori::where('name', 'aj')->get();
            foreach ($ecatalogs as $row) {
                $aj = $row->id;
                $jumlah = $row->jumlah - $request->aj;
                $ecatalog = Inventori::find($aj);
                $ecatalog->update([
                    'jumlah' => $jumlah,
                ]);
            }
        endif;
        if ($request->cr != $penjualan->cr) :

            $ecatalogs = Inventori::where('name', 'cr')->get();
            foreach ($ecatalogs as $row) {
                $cr = $row->id;
                $jumlah = $row->jumlah - $request->cr;
                $ecatalog = Inventori::find($cr);
                $ecatalog->update([
                    'jumlah' => $jumlah,
                ]);
            }
        endif;
        if ($request->k != $penjualan->k) :

            $ecatalogs = Inventori::where('name', 'k')->get();
            foreach ($ecatalogs as $row) {
                $k = $row->id;
                $jumlah = $row->jumlah - $request->k;
                $ecatalog = Inventori::find($k);
                $ecatalog->update([
                    'jumlah' => $jumlah,
                ]);
            }
        endif;
        if ($request->toi != $penjualan->toi) :

            $ecatalogs = Inventori::where('name', 'toi')->get();
            foreach ($ecatalogs as $row) {
                $toi = $row->id;
                $jumlah = $row->jumlah - $request->toi;
                $ecatalog = Inventori::find($toi);
                $ecatalog->update([
                    'jumlah' => $jumlah,
                ]);
            }
        endif;
        if ($request->gulabatok != $penjualan->gulabatok) :

            $ecatalogs = Inventori::where('name', 'tjawa')->get();
            foreach ($ecatalogs as $row) {
                $gulabatok = $row->id;
                $jumlah = $row->jumlah - $request->gulabatok;
                $ecatalog = Inventori::find($gulabatok);
                $ecatalog->update([
                    'jumlah' => $jumlah,
                ]);
            }
        endif;
        if ($request->ar5 != $penjualan->ar5) :

            $ecatalogs = Inventori::where('name', 'ar5')->get();
            foreach ($ecatalogs as $row) {
                $ar5 = $row->id;
                $jumlah = $row->jumlah - $request->ar5;
                $ecatalog = Inventori::find($ar5);
                $ecatalog->update([
                    'jumlah' => $jumlah,
                ]);
            }
        endif;
        if ($request->ar1 != $penjualan->ar1) :

            $ecatalogs = Inventori::where('name', 'ar1')->get();
            foreach ($ecatalogs as $row) {
                $ar1 = $row->id;
                $jumlah = $row->jumlah - $request->ar1;
                $ecatalog = Inventori::find($ar1);
                $ecatalog->update([
                    'jumlah' => $jumlah,
                ]);
            }
        endif;
        if ($request->rg1 != $penjualan->rg1) :

            $ecatalogs = Inventori::where('name', 'rg1')->get();
            foreach ($ecatalogs as $row) {
                $rg1 = $row->id;
                $jumlah = $row->jumlah - $request->rg1;
                $ecatalog = Inventori::find($rg1);
                $ecatalog->update([
                    'jumlah' => $jumlah,
                ]);
            }
        endif;
        if ($request->rg5 != $penjualan->rg5) :

            $ecatalogs = Inventori::where('name', 'rg5')->get();
            foreach ($ecatalogs as $row) {
                $rg5 = $row->id;
                $jumlah = $row->jumlah - $request->rg5;
                $ecatalog = Inventori::find($rg5);
                $ecatalog->update([
                    'jumlah' => $jumlah,
                ]);
            }
        endif;
        if ($request->rg25 != $penjualan->rg25) :

            $ecatalogs = Inventori::where('name', 'rg25')->get();
            foreach ($ecatalogs as $row) {
                $rg25 = $row->id;
                $jumlah = $row->jumlah - $request->rg25;
                $ecatalog = Inventori::find($rg25);
                $ecatalog->update([
                    'jumlah' => $jumlah,
                ]);
            }
        endif;
        if ($request->rgk1 != $penjualan->rgk1) :

            $ecatalogs = Inventori::where('name', 'rgkotak')->get();
            foreach ($ecatalogs as $row) {
                $rgkotak = $row->id;
                $jumlah = $row->jumlah - $request->rgk1;
                $ecatalog = Inventori::find($rgkotak);
                $ecatalog->update([
                    'jumlah' => $jumlah,
                ]);
            }
        endif;
        if ($request->toi != $penjualan->toi) :
            $ecatalogs = Inventori::where('name', 'toi')->get();
            foreach ($ecatalogs as $row) {
                $toi = $row->id;
                $jumlah = $row->jumlah - $request->toi;
                $ecatalog = Inventori::find($toi);
                $ecatalog->update([
                    'jumlah' => $jumlah,
                ]);
            }
        endif;
        $penjualans = Penjualan::find($penjualan->id);
        $penjualans->update([
            'gulabatok' => $request->gulabatok,
            'ar25' => $request->ar25,
            'ar5' => $request->ar5,
            'ar1' => $request->ar1,
            'rg25' => $request->rg25,
            'rg5' => $request->rg5,
            'rg1' => $request->rg1,
            'rgk1' => $request->rgk1,
            'gsm' => $request->gsm,
            'cr' => $request->cr,
            'aj' => $request->aj,
            'k' => $request->k,
            'toi' => $request->toi,
        ]);



        return back()->with('success', "Data Telah Diupdate");
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function delete($penjualan)
    {

        Alert::success('Berhasil', 'Berhasil Menghapus Data !');
        Penjualan::find($penjualan)->delete();
        return back()->with('success', "Data Telah Didelete");
    }
}
