<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'kategori_kode' => 'ELK', 
                'kategori_nama' => 'Elektronik'
            ],
            [
                'kategori_kode' => 'PKN', 
                'kategori_nama' => 'Pakaian'
            ],
            [
                'kategori_kode' => 'MKN', 
                'kategori_nama' => 'Makanan'
            ],
            [
                'kategori_kode' => 'KSH', 
                'kategori_nama' => 'Kesehatan'
            ],
            [
                'kategori_kode' => 'KCN', 
                'kategori_nama' => 'Kecantikan'
            ],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
