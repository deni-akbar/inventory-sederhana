-Download dan ekstrak file inventory-sederhana ke htdocs

-Buka XAMPP jalankan apache dan mysql

-Buka phpMyAdmin dan import inventory.sql(file berada didalam folder inventory-sederhana)

-Setting file .env(file berada didalam folder inventory-sederhana) pastikan nama database sesuai

-Buka CMD dan cd ke htdocs/inventory-sederhana

-Jalankan php artisan serv

-Jalankan Seed:
  -php artisan db:seed --class=UsersTableSeeder

-Buka localhost:8000 dan lakukan login:
Sebagai Admin:
 -Email : TestAdmin@gmail.com
 -Pass 	: password

Sebagai Supplier:
 -Email : TestSupplier@gmail.com
 -Pass 	: password

Sebagai Pelanggan:
 -Email : TestPelanggan@gmail.com
 -Pass 	: password

-Sebelum melakukan transaksi pembelian/penjualan, silahkan 
 tambahkan data barang,supplier atau pelanggan pada menu MASTER(Admin).




