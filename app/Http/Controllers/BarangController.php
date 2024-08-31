<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index() 
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Daftar Barang'
        ];

        $kategori = KategoriModel::all();
        
        return view('barang.index', compact('breadcrumb', 'page', 'kategori'));
    }

    public function list(Request $request)
    {
        $barangs = BarangModel::select('barang_id', 'kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual')->with('kategori');

        if ($request->kategori_id) {
            $barangs->where('kategori_id', $request->kategori_id);
        }
        
        return DataTables::of($barangs)->addIndexColumn()->addColumn('aksi', function ($barang) {  
            $btn  = '<a href="'.url('/barang/' . $barang->barang_id). '" class="btn btn-info btn-sm mx-1">Detail</a>';
            $btn .= '<a href="'.url('/barang/' . $barang->barang_id . '/edit') . '"class="btn btn-warning btn-sm mx-1">Edit</a>';
            $btn .= '<form class="d-inline-block" method="POST" action="' . url('/barang/'.$barang->barang_id).'">' . csrf_field() . method_field('DELETE') . 
                        '<button type="submit" class="btn btn-danger btn-sm mx-1" onclick="return confirm(\'Apakah Anda yakin menghapus data ini ?\');">Hapus</button>
                    </form>';
            return $btn;
        })->rawColumns(['aksi'])->make(true);
    }

    public function create() 
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Barang Baru'
        ];

        $kategori = KategoriModel::all();

        return view('barang.create', compact('breadcrumb', 'page', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|integer',
            'barang_kode' => 'required|string|min:3|unique:m_barang,barang_kode',
            'barang_nama' => 'required|string|min:100',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
        ]);

        BarangModel::create($request->all());

        return redirect('barang')->with('success', 'Data Barang berhasil disimpan');
    }

    public function show($id)
    {
        $barang = BarangModel::with('kategori')->find($id);

        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Barang'
        ];

        return view('barang.show', compact('breadcrumb', 'page', 'barang'));
    }

    public function edit($id)
    {
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Barang',
            'list' => ['Home',  'Barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Barang'
        ];

        return view('barang.edit', compact('breadcrumb', 'page', 'barang', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required|integer',
            'barang_kode' => 'required|string|min:3|unique:m_barang,barang_kode,' . $id . ',barang_id',
            'barang_nama' => 'required|string|min:100',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
        ]);

        BarangModel::find($id)->update($request->all());
        
        return redirect('barang')->with('success', "Data Barang berhasil diubah");
    }

    public function destroy($id)
    {
        $barang = BarangModel::find($id);

        if ($barang) {
            $barang->delete();
            return redirect('barang')->with('success', 'Data Barang berhasil dihapus');
        } else {
            return redirect('barang')->with('error', 'Data Barang gagal dihapus / tidak ditemukan');
        }
    }
}
