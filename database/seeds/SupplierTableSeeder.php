<?php

use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('supplier')->insert([
            'id_supplier' => "",
			'nama' => "",
			'no_telp' => "",
            'alamat' => ""
		]);
    }
}
