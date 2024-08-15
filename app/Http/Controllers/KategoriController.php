<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    //
    public function index() {
        // Insert data
        // $data = [
        //     'kategori_kode'=>'SNK',
        //     'kategori_nama'=>'Scank/Makanan Ringan',
        //     'created_at'=>now(),
        // ];
        // DB::table('m_kategori')->insert($data);
        // return 'Data berhasil ditambahkan';

        //Update data
        // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->update(['kategori_nama'=>'Camilan']);
        // return 'Update data berhasil, jumlah data yang terupdate ' . $row . ' baris';
        
        // Delete data
        // $data = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
        // return 'Delete data berhasil, jumlah data yang terhapus ' . $data . ' baris';
        
        // Menampilkan data
        $data = DB::table('m_kategori')->get();
        return view('kategori', ['data'=>$data]);
    }
}
