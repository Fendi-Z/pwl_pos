<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\StokModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    public function index() 
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok',
            'list' => ['Home', 'Stok']
        ];

        $page = (object) [
            'title' => 'Daftar Stok'
        ];

        $barang = BarangModel::all();
        $user = UserModel::all();
        
        return view('stok.index', compact('breadcrumb', 'page', 'barang', 'user'));
    }

    public function list(Request $request)
    {
        $stoks = StokModel::select('stok_id', 'barang_id', 'stok_tanggal', 'stok_jumlah', 'user_id')->with(['barang', 'user']);

        if ($request->user_id) {
            $stoks->where('user_id', $request->user_id);
        } 
        
        return DataTables::of($stoks)->addIndexColumn()->addColumn('aksi', function ($stok) {  
            $btn  = '<a href="'.url('/stok/' . $stok->stok_id). '" class="btn btn-info btn-sm mx-1">Detail</a>';
            $btn .= '<a href="'.url('/stok/' . $stok->stok_id . '/edit') . '"class="btn btn-warning btn-sm mx-1">Edit</a>';
            $btn .= '<form class="d-inline-block" method="POST" action="' . url('/stok/'.$stok->stok_id).'">' . csrf_field() . method_field('DELETE') . 
                        '<button type="submit" class="btn btn-danger btn-sm mx-1" onclick="return confirm(\'Apakah Anda yakin menghapus data ini ?\');">Hapus</button>
                    </form>';
            return $btn;
        })->rawColumns(['aksi'])->make(true);
    }

    public function create() 
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok',
            'list' => ['Home', 'Stok', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Stok Baru'
        ];

        $barang = BarangModel::all();
        $user = UserModel::all();

        return view('stok.create', compact('breadcrumb', 'page', 'barang', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:m_barang,barang_id',
            'user_id' => 'required|exists:m_user,user_id',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:1'
        ]);

        // Cari stok berdasarkan barang_id dan user_id
        $existingStok = StokModel::where('barang_id', $request->barang_id)
                                ->where('user_id', $request->user_id)
                                ->first();

        if ($existingStok) {
            // Jika stok sudah ada, tambahkan jumlah stok yang baru dan perbarui tanggalnya
            $existingStok->stok_jumlah += $request->stok_jumlah;
            $existingStok->stok_tanggal = $request->stok_tanggal; // Update tanggalnya
            $existingStok->save();
        } else {
            // Jika stok belum ada, buat stok baru
            StokModel::create($request->all());
        }

        return redirect('/stok')->with('success', 'Data Stok berhasil disimpan');
    }

    public function show($id)
    {
        $stok = StokModel::with('user')->find($id);

        $breadcrumb = (object) [
            'title' => 'Daftar Stok',
            'list' => ['Home', 'Stok', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Stok'
        ];

        return view('stok.show', compact('breadcrumb', 'page', 'stok'));
    }

    public function edit($id)
    {
        $stok = StokModel::find($id);
        $barang = BarangModel::all();
        $user = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Stok',
            'list' => ['Home',  'Stok', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Stok'
        ];

        return view('stok.edit', compact('breadcrumb', 'page', 'stok', 'barang', 'user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:m_barang,barang_id',
            'user_id' => 'required|exists:m_user,user_id',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:1'
        ]);
    
        $stok = StokModel::find($id);
    
        if ($stok) {
            // Update jumlah stok dan tanggalnya
            $stok->barang_id = $request->barang_id;
            $stok->user_id = $request->user_id;
            $stok->stok_jumlah = $request->stok_jumlah;
            $stok->stok_tanggal = $request->stok_tanggal; // Update tanggalnya
            $stok->save();
        } else {
            return redirect('/stok')->with('error', 'Stok tidak ditemukan');
        }
    
        return redirect('/stok')->with('success', 'Data Stok berhasil diubah');
    }

    public function destroy($id)
    {
        $barang = BarangModel::find($id);

        if ($barang) {
            $barang->delete();
            return redirect('barang')->with('success', 'Data Stok berhasil dihapus');
        } else {
            return redirect('barang')->with('error', 'Data Stok gagal dihapus / tidak ditemukan');
        }
    }
}
