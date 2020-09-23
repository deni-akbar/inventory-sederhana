<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Barang;
use Cookie;

class PembelianController extends Controller
{
	
    public function index(){
        $supplier = DB::table('supplier')->get();
		$barang = DB::table('barang')->get();
		
		//MENGAMBIL DATA DARI COOKIE
		$carts = json_decode(request()->cookie('dw-carts'), true);
		//UBAH ARRAY MENJADI COLLECTION, KEMUDIAN GUNAKAN METHOD SUM UNTUK MENGHITUNG SUBTOTAL
		$subtotal = collect($carts)->sum(function($q) {
			return $q['jumlah'] * $q['harga']; //SUBTOTAL TERDIRI DARI QTY * PRICE
		});

        return view('pembelian',compact('supplier','barang','carts','subtotal'));
    }
 

	public function store(Request $request)
	{
		$this->validate($request, [
			'id_supplier' => 'required', 
			'tgl_beli' => 'required',         
		]);

		$carts = json_decode($request->cookie('dw-carts'), true);

		$number=DB::table('pembelian')->count();
		$id = 'TB'.sprintf('%03d',$number);
		
		DB::table('pembelian')->insert([
            'id_beli' => $id,
			'tgl_beli' => $request->tgl_beli,
			'id_supplier' => $request->id_supplier,
			'total' => $request->subtotal,
			'id_user' => Auth::user()->id
		]);
		foreach($carts as $c){
			$barang= Barang::find($c['id_barang']);
			
			DB::table('detail_pembelian')
			->insert(['id_beli' => $id,
					 'id_barang' => $c['id_barang'],
					 'harga' => $c['harga'],
					 'jumlah' => $c['jumlah']]);
					 unset($carts[$c['id_barang']]);
		DB::table('barang')->where('id_barang',$c['id_barang'])->increment('stok', $c['jumlah']);	

		}
		// DB::table('detail_pembelian')->insert($carts);
		
		$cookie = cookie('dw-carts', json_encode($carts), 2880);
        return redirect()->back()->cookie($cookie)->with('msg','Pembelian Berhasil');
 
	}
 

	
}