<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'barang_kode' => 'BRG001', 
                'barang_nama' => 'Laptop', 
                'kategori_id' => 1, 
                'harga_beli' => 5000000, 
                'harga_jual' => 6000000
            ],
            [
                'barang_kode' => 'BRG002', 
                'barang_nama' => 'Smartphone', 
                'kategori_id' => 1, 
                'harga_beli' => 3000000, 
                'harga_jual' => 3500000
            ],
            [
                'barang_kode' => 'BRG003', 
                'barang_nama' => 'Jacket', 
                'kategori_id' => 2, 
                'harga_beli' => 150000, 
                'harga_jual' => 200000
            ],
            [
                'barang_kode' => 'BRG004', 
                'barang_nama' => 'Shirt', 
                'kategori_id' => 2, 
                'harga_beli' => 80000, 
                'harga_jual' => 120000
            ],
            [
                'barang_kode' => 'BRG005', 
                'barang_nama' => 'Chocolate', 
                'kategori_id' => 3, 
                'harga_beli' => 20000, 
                'harga_jual' => 30000
            ],
            [
                'barang_kode' => 'BRG006', 
                'barang_nama' => 'Coffee', 
                'kategori_id' => 3, 
                'harga_beli' => 25000, 
                'harga_jual' => 35000
            ],
            [
                'barang_kode' => 'BRG007', 
                'barang_nama' => 'Vitamins', 
                'kategori_id' => 4, 
                'harga_beli' => 50000, 
                'harga_jual' => 75000
            ],
            [
                'barang_kode' => 'BRG008', 
                'barang_nama' => 'First Aid Kit', 
                'kategori_id' => 4, 
                'harga_beli' => 80000, 
                'harga_jual' => 100000
            ],
            [
                'barang_kode' => 'BRG009', 
                'barang_nama' => 'Lipstick', 
                'kategori_id' => 5, 
                'harga_beli' => 100000, 
                'harga_jual' => 150000
            ],
            [
                'barang_kode' => 'BRG010', 
                'barang_nama' => 'Foundation', 
                'kategori_id' => 5, 
                'harga_beli' => 120000, 
                'harga_jual' => 170000
            ],
        ];
        DB::table('m_barang')->insert($data);
    }
}
