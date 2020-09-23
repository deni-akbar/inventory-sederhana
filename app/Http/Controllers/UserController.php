<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

 
class UserController extends Controller
{
	
    
 

	public function store(Request $request)
	{
        $this->validate($request, [
			'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',       
		]);
		

		DB::table('users')->insert([

			'name' => $request->name,
            'email' => $request->email,
            'roles' => $request->roles,
            'password' => bcrypt($request->password)
		]);
		
		return redirect('/admin/home');
 
	}
 

	public function edit($id)
	{
        $pelanggan = DB::table('users')->where('id',$id)->get();
		return view('admin.editPelanggan',['users' => $users]);
	}
 

	public function update(Request $request)
	{
        DB::table('users')->where('id',$request->id)->update([
			'nama' => $request->nama,
			'no_telp' => $request->no_telp,
            'alamat' => $request->alamat
		]);

		return redirect('/admin/home');

	}
 

	public function destroy($id)
	{
        DB::table('users')->where('id',$id)->delete();
		

		return redirect('/admin/home');
	}
}