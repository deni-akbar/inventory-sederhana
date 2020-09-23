<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

 
class BarangController extends Controller
{
	
 
 
	public function store(Request $request)
	{
        $this->validate($request, [
			'nama' => 'required', 
			'deskripsi' => 'required', 
			'harga' => 'required',
			'stok' => 'required',           
		]);
		
        $number=DB::table('barang')->count();
        $id = 'B'.sprintf('%03d',$number);

		DB::table('barang')->insert([
            'id_barang' => $id,
			'nama' => $request->nama,
			'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok
		]);
		
		return redirect('/admin/home');
 
	}
 

	public function edit($id)
	{
        $barang = DB::table('barang')->where('id_barang',$id)->get();
		return view('admin.editBarang',['barang' => $barang]);
	}
 

	public function update(Request $request)
	{
        DB::table('barang')->where('id_barang',$request->id_barang)->update([
			'nama' => $request->nama,
			'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok
		]);

		return redirect('/admin/home');

	}
 

	public function destroy($id)
	{
        DB::table('barang')->where('id_barang',$id)->delete();
		

		return redirect('/admin/home');
	}
}