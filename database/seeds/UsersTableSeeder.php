<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
			'name' => "TestAdmin",
            'email' => "TestAdmin".'@gmail.com',
            'roles' => 1,
            'password' => Hash::make('password')
        ]);
        
        DB::table('users')->insert([
			'name' => "TestSupplier",
            'email' => "TestSupplier".'@gmail.com',
            'roles' => 2,
            'password' => Hash::make('password')
        ]);
        
        DB::table('users')->insert([
			'name' => "TestPelanggan",
            'email' => "TestPelanggan".'@gmail.com',
            'roles' => 3,
            'password' => Hash::make('password')
		]);
    }
}
