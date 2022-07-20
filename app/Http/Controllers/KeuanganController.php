<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Jimmyjs\ReportGenerator\Facades\PdfReportFacade;
use Jimmyjs\ReportGenerator\Facades\ExcelReportFacade;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keuangan = Keuangan::all();
        return view('keuangan.index', compact('keuangan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('keuangan.create');
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
            'kode' => 'required',
        ]);
        Keuangan::create([
            'masuk' => $request->masuk,
            'keluar' => $request->keluar,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'kode' => $request->kode,
            'fd' => $request->fd,

        ]);

        Alert::success('Berhasil', 'Berhaspil Menambah Data !');

        return back()->with('success', "Data berhasil ditambah");
    }
    public function rekap_harian()
    {
        $today = date('Y-m-d');
        $a = DB::table('keuangan')
            ->select('kode', DB::raw('SUM(masuk)  as total_bahan'), DB::raw('SUM(keluar)  as total_kel'))
            ->groupBy('kode')
            ->get();
        return view('keuangan.rekap', compact('a'));
    }

    public function rekap_bulanan()
    {

        $month = date('y-m');
        $a =  Keuangan::where('created_at', 'like', "%" . $month . "%")->get();
        return view('keuangan.rekap', compact('a'));
    }

    public function displayReport(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = $request->input('sort_by');

        $title = 'Rekapan Perbulan Bagian Keuangan'; // Report title

        $meta = [ // For displaying filters description on header
            'Pada Tanggal' => $fromDate . ' To ' . $toDate,
        ];

        $queryBuilder = Keuangan::select(['kode', 'masuk', 'keluar', 'created_at']) // Do some querying..
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->orderBy($sortBy);

        $columns = [ // Set Column to be displayed
            'kode' => 'kode',
            'Tanggal', // if no column_name specified, this will automatically seach for snake_case of column name (will be created_at) column from query result
            'Total Uang Masuk' => 'masuk',
            'Total Uang Keluar' => 'keluar',

        ];

        // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
        return PdfReportFacade::of($title, $meta, $queryBuilder, $columns)
            ->editColumn('Tanggal', [ // Change column class or manipulate its data for displaying to report
                'displayAs' => function ($result) {
                    return $result->created_at->format('d M y');
                },
                'class' => 'left'
            ])
            ->editColumns(['kode', 'Total Uang Masuk', 'Total Uang Keluar', 'Tanggal'], [ // Mass edit column
                'class' => 'right bold'
            ])
            ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                'Total Uang Masuk' => 'point',
                'Total Uang Keluar' => 'point'
                // if you want to show dollar sign ($) then use 'Total Balance' => '$'
            ])
            ->groupBy('kode')
            ->limit(20) // Limit record to be showed
            ->stream(); // other available method: store('path/to/file.pdf') to save to disk, download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function show(Keuangan $keuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function edit(Keuangan $keuangan)
    {
        return view('keuangan.edit', compact('keuangan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $keuangan)
    {
        $this->validate($request, [
            'tanggal' => 'required',
        ]);
        Keuangan::whereId($keuangan)->update($request->except(['_method', '_token']));


        Alert::success('Berhasil', 'Berhasil Mengedit Data !');

        return back()->with('success', "Bs has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function delete($keuangan)
    {

        Alert::success('Berhasil', 'Berhasil Menghapus Data !');
        Keuangan::find($keuangan)->delete();
        return back()->with('success', "Data Telah Didelete");
    }
}
