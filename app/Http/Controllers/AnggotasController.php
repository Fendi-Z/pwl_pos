<?php

namespace App\Http\Controllers;

use App\Models\Anggotas;
use Illuminate\Http\Request;

class AnggotasController extends Controller
{
    //
    public function cekObject() {
        $anggota = new Anggotas;

        dump($anggota);
    }

    public function insert() {
        $anggota = new Anggotas;
        $anggota->nip='1234323';
        $anggota->nama='Dina';
        $anggota->tanggal_lahir='2001-08-31';
        $anggota->nilai='3.5';
        $anggota->save();
        echo 'Data berhasil disimpan';
    }
    
    public function update() {
        $anggota = Anggotas::find(1);
        $anggota->nama='Dono';
        $anggota->nilai='3.0';
        $anggota->save();
        echo 'Data berhasil diupdate';
    }

    public function delete() {
        $anggota = Anggotas::find(1);
        $anggota->delete();
        echo "Data berhasil dihapus";
    }

    public function all() {
        $result = Anggotas::all();
        return view('tampilkan_anggotas', ['anggotas'=>$result]);
    }
    
    public function find() {
        $result = Anggotas::find(3);
        return view('tampilkan_anggotas', ['anggotas'=>[$result]]);
    }

    public function getWhere() {
        $result = Anggotas::where('nilai', '>', '3.3')->orderBy('nama', 'desc')->get();
        return view('tampilkan_anggotas', ['anggotas'=>$result]);
    }
}
