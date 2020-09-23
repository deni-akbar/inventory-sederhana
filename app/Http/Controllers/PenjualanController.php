<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Barang;
use Cookie;

class PenjualanController extends Controller
{
	
    public function index(){
        $pelanggan = DB::table('pelanggan')->get();
		$barang = DB::table('barang')->get();
		
		//MENGAMBIL DATA DARI COOKIE
		$carts = json_decode(request()->cookie('jual-carts'), true);
		//UBAH ARRAY MENJADI COLLECTION, KEMUDIAN GUNAKAN METHOD SUM UNTUK MENGHITUNG SUBTOTAL
		$subtotal = collect($carts)->sum(function($q) {
			return $q['jumlah'] * $q['harga']; //SUBTOTAL TERDIRI DARI QTY * PRICE
		});

        return view('penjualan',compact('pelanggan','barang','carts','subtotal'));
    }
 

	public function store(Request $request)
	{
		$this->validate($request, [
			'id_pelanggan' => 'required', 
			'tgl_jual' => 'required',
			'subtotal' => 'required|numeric|min:0|not_in:0',          
		]);

		$carts = json_decode($request->cookie('jual-carts'), true);

		$number=DB::table('penjualan')->count();
		$id = 'TJ'.sprintf('%03d',$number);
		
		DB::table('penjualan')->insert([
			'id_jual' => $id,
			'tgl_jual' => $request->tgl_jual,
			'id_pelanggan' => $request->id_pelanggan,
			'total' => $request->subtotal,
			'id_user' => Auth::user()->id
			]);	

		foreach($carts as $c){
			$barang= Barang::find($c['id_barang']);
			$hasil=$barang->stok-$c['jumlah'];
			if($hasil<0){
				DB::table('penjualan')->where('id_jual',$id)->delete();
				return redirect()->back()->withErrors(['Stok tidak mencukupi']);
				}else{
			DB::table('detail_penjualan')
			->insert(['id_jual' => $id,
					 'id_barang' => $c['id_barang'],
					 'harga' => $c['harga'],
					 'jumlah' => $c['jumlah']]);
					 unset($carts[$c['id_barang']]);
			DB::table('barang')->where('id_barang',$c['id_barang'])->decrement('stok', $c['jumlah']);	
		}
			 
		}
		
		$cookie = cookie('jual-carts', json_encode($carts), 2880);
        return redirect()->back()->cookie($cookie)->with('msg','Penjualan Berhasil');
 
	}
 

	
}