<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'user_id' => 1, 
                'pembeli' => 'John Doe', 
                'penjualan_kode' => 'PJ001', 
                'penjualan_tanggal' => '2024-08-01'
            ],
            [
                'user_id' => 1, 
                'pembeli' => 'Jane Doe', 
                'penjualan_kode' => 'PJ002', 
                'penjualan_tanggal' => '2024-08-01'
            ],
            [
                'user_id' => 2, 
                'pembeli' => 'Alice Smith', 
                'penjualan_kode' => 'PJ003', 
                'penjualan_tanggal' => '2024-08-01'
            ],
            [
                'user_id' => 2, 
                'pembeli' => 'Bob Brown', 
                'penjualan_kode' => 'PJ004', 
                'penjualan_tanggal' => '2024-08-02'
            ],
            [
                'user_id' => 3, 
                'pembeli' => 'Charlie White', 
                'penjualan_kode' => 'PJ005', 
                'penjualan_tanggal' => '2024-08-02'
            ],
            [
                'user_id' => 3, 
                'pembeli' => 'Daisy Black', 
                'penjualan_kode' => 'PJ006', 
                'penjualan_tanggal' => '2024-08-03'
            ],
            [
                'user_id' => 1, 
                'pembeli' => 'Eva Green', 
                'penjualan_kode' => 'PJ007', 
                'penjualan_tanggal' => '2024-08-03'
            ],
            [
                'user_id' => 1, 
                'pembeli' => 'Frank Blue', 
                'penjualan_kode' => 'PJ008', 
                'penjualan_tanggal' => '2024-08-03'
            ],
            [
                'user_id' => 2, 
                'pembeli' => 'Grace Red', 
                'penjualan_kode' => 'PJ009', 
                'penjualan_tanggal' => '2024-08-04'
            ],
            [
                'user_id' => 2, 
                'pembeli' => 'Hannah Yellow', 
                'penjualan_kode' => 'PJ010', 
                'penjualan_tanggal' => '2024-08-05'
            ],
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
