<?php

use Illuminate\Database\Seeder;

class PelangganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pelanggan')->insert([
            'id_pelanggan' => "",
			'nama' => "",
			'no_telp' => "",
            'alamat' => ""
		]);
    }
}
