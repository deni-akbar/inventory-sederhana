<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Barang;

class SessionController extends Controller
{
	
 
 
	public function store(Request $request)
	{
     

    //AMBIL DATA CART DARI COOKIE, KARENA BENTUKNYA JSON MAKA KITA GUNAKAN JSON_DECODE UNTUK MENGUBAHNYA MENJADI ARRAY
    $carts = json_decode($request->cookie('dw-carts'), true); 
  
    //CEK JIKA CARTS TIDAK NULL DAN PRODUCT_ID ADA DIDALAM ARRAY CARTS
    if ($carts && array_key_exists($request->id_barang, $carts)) {
        //MAKA UPDATE QTY-NYA BERDASARKAN PRODUCT_ID YANG DIJADIKAN KEY ARRAY
        $carts[$request->id_barang]['jumlah'] += $request->jumlah;
    } else {
		//SELAIN ITU, BUAT QUERY UNTUK MENGAMBIL PRODUK BERDASARKAN PRODUCT_ID
		$barang = Barang::find($request->id_barang);
        
        //TAMBAHKAN DATA BARU DENGAN MENJADIKAN PRODUCT_ID SEBAGAI KEY DARI ARRAY CARTS
        $carts[$request->id_barang] = [
            'jumlah' => $request->jumlah,
            'id_barang' => $request->id_barang,
            'harga' => $barang->harga
        ];
    }

    //BUAT COOKIE-NYA DENGAN NAME DW-CARTS
    //JANGAN LUPA UNTUK DI-ENCODE KEMBALI, DAN LIMITNYA 2800 MENIT ATAU 48 JAM
    $cookie = cookie('dw-carts', json_encode($carts), 2880);
    //STORE KE BROWSER UNTUK DISIMPAN
    return redirect()->back()->cookie($cookie);
 
	}
 
	public function destroy($id,Request $request){

		$carts = json_decode($request->cookie('dw-carts'), true);

		unset($carts[$id]);
		$cookie = cookie('dw-carts', json_encode($carts), 2880);
        return redirect()->back()->cookie($cookie);
    }
    
    public function storeJ(Request $request)
	{
     

    //AMBIL DATA CART DARI COOKIE, KARENA BENTUKNYA JSON MAKA KITA GUNAKAN JSON_DECODE UNTUK MENGUBAHNYA MENJADI ARRAY
    $carts = json_decode($request->cookie('jual-carts'), true); 
  
    //CEK JIKA CARTS TIDAK NULL DAN PRODUCT_ID ADA DIDALAM ARRAY CARTS
    if ($carts && array_key_exists($request->id_barang, $carts)) {
        //MAKA UPDATE QTY-NYA BERDASARKAN PRODUCT_ID YANG DIJADIKAN KEY ARRAY
        $carts[$request->id_barang]['jumlah'] += $request->jumlah;
    } else {
		//SELAIN ITU, BUAT QUERY UNTUK MENGAMBIL PRODUK BERDASARKAN PRODUCT_ID
		$barang = Barang::find($request->id_barang);
        
        //TAMBAHKAN DATA BARU DENGAN MENJADIKAN PRODUCT_ID SEBAGAI KEY DARI ARRAY CARTS
        $carts[$request->id_barang] = [
            'jumlah' => $request->jumlah,
            'id_barang' => $request->id_barang,
            'harga' => $barang->harga
        ];
    }

    //BUAT COOKIE-NYA DENGAN NAME DW-CARTS
    //JANGAN LUPA UNTUK DI-ENCODE KEMBALI, DAN LIMITNYA 2800 MENIT ATAU 48 JAM
    $cookie = cookie('jual-carts', json_encode($carts), 2880);
    //STORE KE BROWSER UNTUK DISIMPAN
    return redirect()->back()->cookie($cookie);
 
    }
    
    public function destroyJ($id,Request $request){

		$carts = json_decode($request->cookie('jual-carts'), true);

		unset($carts[$id]);
		$cookie = cookie('jual-carts', json_encode($carts), 2880);
        return redirect()->back()->cookie($cookie);
    }
}