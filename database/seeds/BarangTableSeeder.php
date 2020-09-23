<?php

use Illuminate\Database\Seeder;

class BarangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barang')->insert([
            'id_barang' => "",
			'nama' => "",
			'deskripsi' => "",
            'harga' => "",
            'stok' => ""
		]);
		
    }
}
