<?php

namespace App\Http\Controllers;

use App\Models\Inventori;
use App\Models\Produksi_Detail;
use App\Models\Inventori_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Jimmyjs\ReportGenerator\Facades\PdfReportFacade;

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
        $databaku = Inventori::where('jenis', 'bahan baku')->get();
        $datahasil = Inventori::where('jenis', 'barang hasil')->get();
        return view('inventori.create', compact('databaku', 'datahasil'));
    }
    public function tambahbs()
    {

        return view('inventori.bs');
    }
    public function bs(Request $request)
    {
        $this->validate($request, [
            'bs' => 'required',
        ]);
        $ecatalogs = Inventori::where('name', 'rbs')->get();
        foreach ($ecatalogs as $row) {
            $databs = $row->id;
            $jumlah = $row->jumlah + $request->bs;
            $ecatalog = Inventori::find($databs);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }

        return back()->with('success', "Bs has been updated");
    }
    public function bkeluar()
    {
        $inventori = DB::table('inventori_keluar_masuk')->where('keterangan', 'Keluar')->get();

        return view('inventori.databarang', compact('inventori'));
    }
    public function bmasuk(Request $request)
    {
        $inventori = DB::table('inventori_keluar_masuk')->where('keterangan', 'Masuk')->get();

        return view('inventori.databarang', compact('inventori'));
    }
    public function rekap_harian()
    {
        $today = date('Y-m-d');
        $a = DB::table('inventori_keluar_masuk')
            ->where('keterangan', 'Keluar')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(id)  as id'),
                DB::raw('SUM(tjawa)  as total_tjawa'),
                DB::raw('SUM(ar25)  as total_ar25'),
                DB::raw('SUM(ar5)  as total_ar5'),
                DB::raw('SUM(ar1)  as total_ar1'),
                DB::raw('SUM(rg5)  as total_rg5'),
                DB::raw('SUM(rg25)  as total_rg25'),
                DB::raw('SUM(rg1)  as total_rg1'),
                DB::raw('SUM(rgk1)  as total_rgk1'),
                DB::raw('SUM(gp)  as total_gp'),
                DB::raw('SUM(gt)  as total_gt'),
                DB::raw('SUM(aj)  as total_aj'),
                DB::raw('SUM(ar)  as total_ar'),
                DB::raw('SUM(k)  as total_k')
            )
            ->groupBy('date')
            ->get();
        return view('inventori.rekap', compact('a'));
    }
    public function rekap_bulanan()
    {

        $month = date('F, Y');
        $a =  Produksi_Detail::where('created_at', 'like', "%" . $month . "%")->with('produksi')->with('inventori')->get();
        return view('inventori.rekap', compact('a'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function displayReport(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = $request->input('sort_by');
        $jenis = $request->input('jenis');

        $title = 'Rekapan Perbulan Bagian Inventori'; // Report title

        $meta = [ // For displaying filters description on header
            'Pada Tanggal' => $fromDate . ' To ' . $toDate,
        ];
        if ($jenis == 1) {

            $queryBuilder = Inventori_Detail::select(['aj', 'ar', 'gp', 'gt', 'toi', 'k', 'tjawa', 'created_at']) // Do some querying..
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->orderBy('created_at');

                $columns = [ // Set Column to be displayed
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
                ->editColumns([
                    'Total AJ',
                    'Total AR',
                    'Total GP',
                    'Total GT',
                    'Total TOI',
                    'Total K',
                    'Total TJAWA'
                ], [ // Mass edit column
                    'class' => 'right bold'
                ])
                ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                    'Total AJ' => 'point',
                    'Total AR' => 'point',
                    'Total GP' => 'point',
                    'Total GT' => 'point',
                    'Total TOI' => 'point',
                    'Total K' => 'point',
                    'Total TJAWA' => 'point'
                    // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                ])
                ->groupBy('Tanggal')
                ->limit(20) // Limit record to be showed
                ->stream(); // other available method: store('path/to/file.pdf') to save to disk, download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()

        } else {
            $queryBuilder = Inventori_Detail::select(['cr', 'gsm', 'ar25', 'ar5', 'ar1', 'rg25', 'rg5', 'rg1', 'rgk1', 'bs', 'created_at']) // Do some querying..
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->orderBy($sortBy);
            
            $columns = [ // Set Column to be displayed
                'Tanggal', // if no column_name specified, this will automatically seach for snake_case of column name (will be created_at) column from query result
                'Total CR' => 'cr',
                'Total GSM' => 'gsm',
                'Total AR25' => 'ar25',
                'Total AR5' => 'ar5',
                'Total AR1' => 'ar1',
                'Total RG25' => 'rg25',
                'Total RG5' => 'rg5',
                'Total RG1' => 'rg1',
                'Total RGk1' => 'rgk1',
                'Total BS' => 'bs',
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
                ->editColumns([
                    'Tanggal', // if no column_name specified, this will automatically seach for snake_case of column name (will be created_at) column from query result
                    'Total CR',
                    'Total GSM',
                    'Total AR25',
                    'Total AR5',
                    'Total AR1',
                    'Total RG25',
                    'Total RG5',
                    'Total RG1',
                    'Total RGk1',
                    'Total BS',
                    'Total TJAWA', 
                ], [ // Mass edit column
                    'class' => 'right bold'
                ])
                ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                    'Total CR' => 'point',
                    'Total GSM' => 'point',
                    'Total AR25' => 'point',
                    'Total AR5' => 'point',
                    'Total AR1' => 'point',
                    'Total RG25' => 'point',
                    'Total RG5' => 'point',
                    'Total RG1' => 'point',
                    'Total RGk1' => 'point',
                    'Total BS' => 'point',
                    'Total TJAWA' => 'point',
                    // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                ])
                ->groupBy('Tanggal')
                ->limit(20) // Limit record to be showed
                ->stream(); // other available method: store('path/to/file.pdf') to save to disk, download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()

        }
    }
    public function store(Request $request)
    {
        $inv_aj = Inventori::where('name', 'aj')->sum('jumlah');
        $inv_ar = Inventori::where('name', 'ar')->sum('jumlah');
        $inv_gp = Inventori::where('name', 'gp')->sum('jumlah');
        $inv_gt = Inventori::where('name', 'gt')->sum('jumlah');
        $inv_toi = Inventori::where('name', 'toi')->sum('jumlah');
        $inv_tjawa = Inventori::where('name', 'tjawa')->sum('jumlah');
        $inv_gsm = Inventori::where('name', 'gsm')->sum('jumlah');
        $inv_ar25 = Inventori::where('name', 'ar25')->sum('jumlah');
        $inv_ar1 = Inventori::where('name', 'ar1')->sum('jumlah');
        $inv_ar5 = Inventori::where('name', 'ar5')->sum('jumlah');
        $inv_rg25 = Inventori::where('name', 'rg25')->sum('jumlah');
        $inv_rg5 = Inventori::where('name', 'rg5')->sum('jumlah');
        $inv_rg1 = Inventori::where('name', 'rg1')->sum('jumlah');
        $inv_rgk1 = Inventori::where('name', 'rgk1')->sum('jumlah');
        $inv_bs = Inventori::where('name', 'bs')->sum('jumlah');
        $inv_k = Inventori::where('name', 'k')->sum('jumlah');
        $inv_tjawa = Inventori::where('name', 'tjawa')->sum('jumlah');

        $request->validate([
            'keterangan' => 'required',
            'jmlhasil' => 'required',
            'jmlbahan' => 'required',
            'keterangan' => 'required',
            'aj' => 'nullable',
            'ar' => 'nullable',
            'gp' => 'nullable',
            'toi' => 'nullable',
            'k' => 'nullable',
            'tjawa' => 'nullable',
            'cr' => 'nullable',
            'gsm' => 'nullable',
            'ar25' => 'nullable',
            'ar5' => 'nullable',
            'ar1' => 'nullable',
            'rg25' => 'nullable',
            'rg5' => 'nullable',
            'rg1' => 'nullable',
            'rgk1' => 'nullable',
            'bs' => 'nullable',
        ]);
        Inventori_Detail::create([
            'aj' => $request->aj,
            'ar' => $request->ar,
            'gp' => $request->gp,
            'toi' => $request->toi,
            'k' => $request->k,
            'tjawa' => $request->tjawa,
            'cr' => $request->cr,
            'gsm' => $request->gsm,
            'ar25' => $request->ar25,
            'ar5' => $request->ar5,
            'ar1' => $request->ar1,
            'rg25' => $request->rg25,
            'rg5' => $request->rg5,
            'rg1' => $request->rg1,
            'rgk1' => $request->rgk1,
            'jmlhasil' =>  str_replace(',', '', $request->jmlhasil),
            'jmlbahan' => str_replace(',', '',  $request->jmlbahan),
            'keterangan' =>  $request->keterangan
        ]);

        $ecatalogs = Inventori::where('name', 'aj')->get();
        foreach ($ecatalogs as $row) {
            $aj = $row->id;
            $jumlah = $row->jumlah + $request->aj;
            $ecatalog = Inventori::find($aj);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'ar')->get();
        foreach ($ecatalogs as $row) {
            $ar = $row->id;
            $jumlah = $row->jumlah + $request->ar;
            $ecatalog = Inventori::find($ar);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'gp')->get();
        foreach ($ecatalogs as $row) {
            $gp = $row->id;
            $jumlah = $row->jumlah + $request->gp;
            $ecatalog = Inventori::find($gp);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'gt')->get();
        foreach ($ecatalogs as $row) {
            $gt = $row->id;
            $jumlah = $row->jumlah + $request->gt;
            $ecatalog = Inventori::find($gt);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'toi')->get();
        foreach ($ecatalogs as $row) {
            $toi = $row->id;
            $jumlah = $row->jumlah + $request->toi;
            $ecatalog = Inventori::find($toi);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'k')->get();
        foreach ($ecatalogs as $row) {
            $k = $row->id;
            $jumlah = $row->jumlah + $request->k;
            $ecatalog = Inventori::find($k);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'tjawa')->get();
        foreach ($ecatalogs as $row) {
            $tjawa = $row->id;
            $jumlah = $row->jumlah + $request->tjawa;
            $ecatalog = Inventori::find($tjawa);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'cr')->get();
        foreach ($ecatalogs as $row) {
            $cr = $row->id;
            $jumlah = $row->jumlah + $request->cr;
            $ecatalog = Inventori::find($cr);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'gms')->get();
        foreach ($ecatalogs as $row) {
            $gms = $row->id;
            $jumlah = $row->jumlah + $request->gms;
            $ecatalog = Inventori::find($gms);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'ar25')->get();
        foreach ($ecatalogs as $row) {
            $ar25 = $row->id;
            $jumlah = $row->jumlah + $request->ar25;
            $ecatalog = Inventori::find($ar25);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'ar5')->get();
        foreach ($ecatalogs as $row) {
            $ar5 = $row->id;
            $jumlah = $row->jumlah + $request->ar5;
            $ecatalog = Inventori::find($ar5);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'ar1')->get();
        foreach ($ecatalogs as $row) {
            $ar1 = $row->id;
            $jumlah = $row->jumlah + $request->ar1;
            $ecatalog = Inventori::find($ar1);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'rg1')->get();
        foreach ($ecatalogs as $row) {
            $rg1 = $row->id;
            $jumlah = $row->jumlah + $request->rg1;
            $ecatalog = Inventori::find($rg1);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'rg5')->get();
        foreach ($ecatalogs as $row) {
            $rg5 = $row->id;
            $jumlah = $row->jumlah + $request->rg5;
            $ecatalog = Inventori::find($rg5);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'rg25')->get();
        foreach ($ecatalogs as $row) {
            $rg25 = $row->id;
            $jumlah = $row->jumlah + $request->rg25;
            $ecatalog = Inventori::find($rg25);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        $ecatalogs = Inventori::where('name', 'rgkotak')->get();
        foreach ($ecatalogs as $row) {
            $rgkotak = $row->id;
            $jumlah = $row->jumlah + $request->rgk1;
            $ecatalog = Inventori::find($rgkotak);
            $ecatalog->update([
                'jumlah' => $jumlah,
            ]);
        }
        Alert::success('Berhasil', 'Berhaspil Menambah Data !');

        return back()->with('success', "Data berhasil ditambah");
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
