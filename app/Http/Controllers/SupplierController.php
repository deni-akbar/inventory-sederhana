<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

 
class SupplierController extends Controller
{
	
 
 

	public function store(Request $request)
	{
        $this->validate($request, [
			'nama' => 'required', 
			'no_telp' => 'required', 
			'alamat' => 'required',         
		]);
		
        $number=DB::table('supplier')->count();
        $id = 'S'.sprintf('%03d',$number);

		DB::table('supplier')->insert([
            'id_supplier' => $id,
			'nama' => $request->nama,
			'no_telp' => $request->no_telp,
            'alamat' => $request->alamat
		]);
		
		return redirect('/admin/home');
 
	}
 

	public function edit($id)
	{
        $supplier = DB::table('supplier')->where('id_supplier',$id)->get();
		return view('admin.editSupplier',['supplier' => $supplier]);
	}
 

	public function update(Request $request)
	{
        DB::table('supplier')->where('id_supplier',$request->id_supplier)->update([
			'nama' => $request->nama,
			'no_telp' => $request->no_telp,
            'alamat' => $request->alamat
		]);

		return redirect('/admin/home');

	}
 

	public function destroy($id)
	{
        DB::table('supplier')->where('id_supplier',$id)->delete();
		

		return redirect('/admin/home');
	}
}