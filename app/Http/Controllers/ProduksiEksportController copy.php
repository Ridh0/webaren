<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use PdfReport;
use ExcelReport;
class ProduksiEksportController extends Controller
{
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
        //
    }
    public function displayReportexcel(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = $request->input('sort_by');

        $title = 'Registered User Report'; // Report title
        $meta = [ // For displaying filters description on header
            'Registered on' => $fromDate . ' To ' . $toDate,
            'Sort By' => $sortBy
        ];
        $queryBuilder = User::select(['name', 'balance', 'created_at']) // Do some querying..
                            ->whereBetween('created_at', [$fromDate, $toDate])
                            ->orderBy($sortBy);
        $columns = [ // Set Column to be displayed
                                'Name' => 'name',
                                'Registered At', // if no column_name specified, this will automatically seach for snake_case of column name (will be created_at) column from query result
                                'Total Balance' => 'balance',
                                'Status' => function($result) { // You can do if statement or any action do you want inside this closure
                                    return ($result->balance > 100000) ? 'Rich Man' : 'Normal Guy';
                                }
                            ];
        return ExcelReport::of($title, $meta, $queryBuilder, $columns)
         ->simple()
         ->download('filename');
    }
    public function displayReport(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = $request->input('sort_by');
    
        $title = 'Registered User Report'; // Report title
    
        $meta = [ // For displaying filters description on header
            'Registered on' => $fromDate . ' To ' . $toDate,
            'Sort By' => $sortBy
        ];
    
        $queryBuilder = User::select(['name', 'balance', 'created_at']) // Do some querying..
                            ->whereBetween('created_at', [$fromDate, $toDate])
                            ->orderBy($sortBy);
    
        $columns = [ // Set Column to be displayed
            'Name' => 'name',
            'Registered At', // if no column_name specified, this will automatically seach for snake_case of column name (will be created_at) column from query result
            'Total Balance' => 'balance',
            'Status' => function($result) { // You can do if statement or any action do you want inside this closure
                return ($result->balance > 100000) ? 'Rich Man' : 'Normal Guy';
            }
        ];
    
        // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
        return PdfReport::of($title, $meta, $queryBuilder, $columns)
                        ->editColumn('Registered At', [ // Change column class or manipulate its data for displaying to report
                            'displayAs' => function($result) {
                                return $result->created_at->format('d M Y');
                            },
                            'class' => 'left'
                        ])
                        ->editColumns(['Total Balance', 'Status'], [ // Mass edit column
                            'class' => 'right bold'
                        ])
                        ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                            'Total Balance' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                        ])
                        ->limit(20) // Limit record to be showed
                        ->stream(); // other available method: store('path/to/file.pdf') to save to disk, download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
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
        //
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
