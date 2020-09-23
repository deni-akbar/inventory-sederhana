<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

 
class PelangganController extends Controller
{
	
 
 

	public function store(Request $request)
	{
        $this->validate($request, [
			'nama' => 'required', 
			'no_telp' => 'required', 
			'alamat' => 'required',         
		]);
		
        $number=DB::table('pelanggan')->count();
        $id = 'P'.sprintf('%03d',$number);

		DB::table('pelanggan')->insert([
            'id_pelanggan' => $id,
			'nama' => $request->nama,
			'no_telp' => $request->no_telp,
            'alamat' => $request->alamat
		]);
		
		return redirect('/admin/home');
 
	}
 

	public function edit($id)
	{
        $pelanggan = DB::table('pelanggan')->where('id_pelanggan',$id)->get();
		return view('admin.editPelanggan',['pelanggan' => $pelanggan]);
	}
 

	public function update(Request $request)
	{
        DB::table('pelanggan')->where('id_pelanggan',$request->id_pelanggan)->update([
			'nama' => $request->nama,
			'no_telp' => $request->no_telp,
            'alamat' => $request->alamat
		]);

		return redirect('/admin/home');

	}
 

	public function destroy($id)
	{
        DB::table('pelanggan')->where('id_pelanggan',$id)->delete();
		

		return redirect('/admin/home');
	}
}