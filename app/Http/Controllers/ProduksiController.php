<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produksi;
use App\Models\Keranjang;
use App\Models\Student;
use App\Models\Produksi_Detail;
use App\Models\Inventori;
use Cart;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProduksiExport;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class ProduksiController extends Controller
{
   
    public function index()
    {
        $produksii = DB::table('produksi_detail')
                 ->select('produksi_id', DB::raw('count(*) as total'))
                 ->groupBy('produksi_id')
                 ->get();
        $produksis = Produksi_Detail::all();
        $produksi = Produksi::with('inventori')->get();
        return view('produksi.index',compact('produksi','produksis','produksii'));
    }

    public function exportPDF() {
       
        $data = Produksi::all();
  
        $pdf = PDF::loadView('pdf', ['data' => $data]);
        
        return $pdf->download('produksi.pdf');
        
      }
    public function create()
    {
        $produksi = Inventori::limit(8)->get();
        return view('produksi.create',compact('produksi'));

    }
    
    public function creates()
    {
        
        $produksi = Inventori::all();
        $pos = Inventori::all();
        $cart_products = Cart::getContent();
        return view('produksi.creates',compact('produksi','pos','cart_products'));

    }
    public function cek()
    {
        $sum_aj = Keranjang::sum('aj');
        $sum_ar = Keranjang::sum('ar');
        $sum_gp = Keranjang::sum('gp');
        $sum_gt = Keranjang::sum('gt');
        $sum_toi = Keranjang::sum('toi');
        $sum_k = Keranjang::sum('k');
        $sum_tjawa = Keranjang::sum('tjawa');
        $sum_rbs = Keranjang::sum('rbs');
        
        $inv_aj = Inventori::where('name','aj')->sum('jumlah');
        $inv_ar = Inventori::where('name','ar')->sum('jumlah');
        $inv_gp = Inventori::where('name','gp')->sum('jumlah');
        $inv_gt = Inventori::where('name','gt')->sum('jumlah');
        $inv_toi = Inventori::where('name','toi')->sum('jumlah');
        $inv_k = Inventori::where('name','k')->sum('jumlah');
        $inv_tjawa = Inventori::where('name','tjawa')->sum('jumlah');
        $inv_rbs = Inventori::where('name','rbs')->sum('jumlah');
        $total_aj = $inv_aj-$sum_aj;
        $total_ar = $inv_ar-$sum_ar;
        $total_gp = $inv_gp-$sum_gp;
        $total_gt = $inv_gt-$sum_gt;
        $total_toi = $inv_toi-$sum_toi;
        $total_k = $inv_k-$sum_k;
        $total_tjawa = $inv_tjawa-$sum_tjawa;
        $total_rbs = $inv_rbs-$sum_rbs;

        $sum_rbs = Keranjang::sum('rbs');
        $inv_aj = Inventori::where('name','aj')->sum('jumlah');
        $cek =  $inv_aj - $sum_rbs;
        $produksi = Inventori::all();
        $keranjang = Keranjang::paginate(2);
        $produksi_detail= Keranjang::all();
        return view('produksi.cek',compact('produksi_detail',
        'produksi','keranjang',
        'total_aj','total_ar','total_gp','total_gt','total_toi',
        'total_k','total_tjawa','total_rbs'));

        
    }
    public function export() 
{
   return Excel::download(new ProduksiExport, 'produksi.xlsx');
}
    public function pos(Request $request)
    { 
        $inputs = $request->except('_token');
  

        $post = new Student;
        $post->nwo = $request->nwo;
        $post->aj = $request->aj;
        $order = new Produksi();
        $order->tanggal_masak = date('Y-m-d');
        $order->total = Cart::getTotal();
        $order->save();
        $order_id = $order->id;
        $contents = Cart::getContent();
       
        foreach ($contents as $content)
        {
            $order_detail = new Produksi_Detail();
            $order_detail->produksi_id = $order_id;
            $order_detail->inventori_id = $content->id;
            $order_detail->quantity = $content->qty;
            $order_detail->save();
        }

        Cart::clear();

        return redirect()->route('produksi');

    }
   
    public function rekap()
    {
        $a =  Produksi_Detail::with('produksi')->with('inventori')->get();

        return view('produksi.rekap',compact('a'));

    }
    public function rekap_harian()
    {
        $today = date('Y-m-d');
        $a =  Produksi_Detail::where('created_at','like',"%".$today."%" )->with('produksi')->with('inventori')->get();
        return view('produksi.rekap',compact('a'));

    }
    
    public function rekaps($produksis)
    {
        
        if($produksi == "harian"){
            $today = date('Y-m-d');

        $a =  Produksi_Detail::with('produksi')->with('inventori')->where('created_at',$today)->get();
            
        
    }else {
            $a =  Produksi_Detail::with('produksi')->with('inventori')->get();

        };
            return view('produksi.rekap',compact('a'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'moreFields.*.id_user' => 'required',
            'moreFields.*.nwo' => 'nullable|unique:produksi',
            'moreFields.*.aj' => 'nullable',
            'moreFields.*.ar' => 'nullable',
            'moreFields.*.gp' => 'nullable',
            'moreFields.*.toi' => 'nullable',
            'moreFields.*.k' => 'nullable',
            'moreFields.*.tjawa' => 'nullable',
            'moreFields.*.rbs' => 'nullable',
        ],
        [
           
            'moreFields.*.nwo.unique:produksi' => 'Account field is required',
        ]);
        foreach ($request->moreFields as $key => $value) {
            Keranjang::create($value);
        }
        $sum_aj = Keranjang::sum('aj');
        $sum_ar = Keranjang::sum('ar');
        $sum_gp = Keranjang::sum('gp');
        $sum_gt = Keranjang::sum('gt');
        $sum_toi = Keranjang::sum('toi');
        $sum_k = Keranjang::sum('k');
        $sum_tjawa = Keranjang::sum('tjawa');
        $sum_rbs = Keranjang::sum('rbs');
        
        $inv_aj = Inventori::where('name','aj')->sum('jumlah');
        $inv_ar = Inventori::where('name','ar')->sum('jumlah');
        $inv_gp = Inventori::where('name','gp')->sum('jumlah');
        $inv_gt = Inventori::where('name','gt')->sum('jumlah');
        $inv_toi = Inventori::where('name','toi')->sum('jumlah');
        $inv_k = Inventori::where('name','k')->sum('jumlah');
        $inv_tjawa = Inventori::where('name','tjawa')->sum('jumlah');
        $inv_rbs = Inventori::where('name','rbs')->sum('jumlah');
      
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors(['msg','$validator'])
            ->withInput();
        }else{
        return redirect(route('produksi.create.cek'))->with('success', 'New subject has been added.');
        };
    }



    public function edit(Request $request, Produksi $produksi)
    {
        $this->validate($request, [
            'id' => 'required',
            'nwo' => 'required',
            ]);
            $data= DB::table('keranjang')->where('id', $request->id)->update([
                'aj' => $request->aj,
                'nwo' => $request->nwo,
                'ar' => $request->ar,
                'gt' => $request->gt,
                'gp' => $request->gp,
                'toi' => $request->toi,
                'k' => $request->k,
                'tjawa' => $request->tjawa,
                'rbs' => $request->rbs,
            ]);
            
            return redirect('/produksi/create/cek')->with('status', 'Data siswa Berhasil Diubah');  
    }

    public function update(Request $request, Produksi $produksi)
    {
        $this->validate($request, [
            'aj' => 'required',
          
            ]);
            $data= DB::table('inventori')->where('name', 'aj')->update([
                'jumlah' => $request->aj,
            ]);
            $Keranjang= Keranjang::all();
            foreach ($Keranjang as  $value) {
                DB::table('produksi')->insert([
                    'nwo' => $value->nwo,
                    'aj' => $value->aj,
                    'ar' => $value->ar,
                    'gt' => $value->gt,
                    'gp' => $value->gp,
                    'toi' => $value->toi,
                    'k' => $value->k,
                    'tjawa' => $value->tjawa,
                    'rbs' => $value->rbs,
                    'jmlbahan' => $value->aj + $value->ar + $value->gt + $value->gp + $value->toi + $value->k + $value->tjawa + $value->rbs,
                    'harga' => $value->harga,
                    'hutang' => $value->hutang,
                    'created_at' => $value->created_at,
                    'updated_at' => $value->updated_at,
                    ]);
            }
            Keranjang::truncate();
            return redirect('/produksi/create/cek')->with('status', 'Data siswa Berhasil Diubah');   
    }

  
}