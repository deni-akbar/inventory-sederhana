<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
  

    public function indexP()
    {
        return view('welcome');
    }

    public function indexS()
    {
        return view('welcome');
    }

    public function adminHome()
    {
        $barang = DB::table('barang')->get();
		$pelanggan = DB::table('pelanggan')->get();
        $supplier = DB::table('supplier')->get();
        $users = DB::table('users')->get();
        return view('admin.home',['barang' => $barang,'pelanggan' => $pelanggan
                                    ,'supplier' => $supplier,'users' => $users]);
        
    }

    public function error()
    {
        return view('denied');
    }
}
