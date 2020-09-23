<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Barang;

class LaporanController extends Controller
{
	
    public function index(){
        $barang = DB::table('barang')->get();

        return view('laporan',['barang'=>$barang]);
    }
 
	public function cari(Request $request)
	{
        $this->validate($request, [
			'startDate' => 'required',  
            'endDate' => 'required',   
            'id_barang' => 'required'        
        ]);
        
        $pembelian = DB::table('pembelian')
                ->join('detail_pembelian','detail_pembelian.id_beli','=','pembelian.id_beli')
                ->where('detail_pembelian.id_barang','=',$request->id_barang)
				->whereBetween('tgl_beli',[$request->startDate,$request->endDate])
                ->get();

        $totbeli = DB::table('detail_pembelian')
                ->join('pembelian','pembelian.id_beli','=','detail_pembelian.id_beli')
                ->where('id_barang','=',$request->id_barang)
				->whereBetween('tgl_beli',[$request->startDate,$request->endDate])
				->sum('jumlah');

        $penjualan = DB::table('penjualan')
                ->join('detail_penjualan','detail_penjualan.id_jual','=','penjualan.id_jual')
                ->where('detail_penjualan.id_barang','=',$request->id_barang)
				->whereBetween('tgl_jual',[$request->startDate,$request->endDate])
                ->get(); 

        $totjual = DB::table('detail_penjualan')
                ->join('penjualan','penjualan.id_jual','=','detail_penjualan.id_jual')
                ->where('id_barang','=',$request->id_barang)
				->whereBetween('tgl_jual',[$request->startDate,$request->endDate])
                ->sum('jumlah');
                
        $date1=date('d-m-Y',strtotime($request->startDate));
        $date2=date('d-m-Y',strtotime($request->endDate));  

        $barang = DB::table('barang')->where('id_barang',$request->id_barang)->get();    
        $stok=DB::table('barang')->where('id_barang',$request->id_barang)->value('stok'); 
        $stokawal=$stok + $totjual - $totbeli;
    return view('laporanCari',['pembelian' => $pembelian,'penjualan' => $penjualan,'stokawal' => $stokawal,'date1' => $date1,'date2' => $date2,'barang' => $barang]);     
	}
 
	
}