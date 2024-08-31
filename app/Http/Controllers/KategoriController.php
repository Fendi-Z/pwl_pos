<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;

class KategoriController extends Controller
{
    public function index() 
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar Kategori'
        ];

        return view('kategori.index', compact('breadcrumb', 'page'));
    }

    public function list()
    {
        $kategoris = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        return DataTables::of($kategoris)->addIndexColumn()->addColumn('aksi', function ($kategori) {  
            $btn  = '<a href="'.url('/kategori/' . $kategori->kategori_id). '" class="btn btn-info btn-sm mx-1">Detail</a>';
            $btn .= '<a href="'.url('/kategori/' . $kategori->kategori_id . '/edit') . '"class="btn btn-warning btn-sm mx-1">Edit</a>';
            $btn .= '<form class="d-inline-block" method="POST" action="' . url('/kategori/'.$kategori->kategori_id).'">' . csrf_field() . method_field('DELETE') . 
                        '<button type="submit" class="btn btn-danger btn-sm mx-1" onclick="return confirm(\'Apakah Anda yakin menghapus data ini ?\');">Hapus</button>
                    </form>';
            return $btn;
        })->rawColumns(['aksi'])->make(true);
    }

    public function create() 
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Kategori Baru'
        ];

        return view('kategori.create', compact('breadcrumb', 'page'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_kode' => 'required|string|min:3|unique:m_level,kategori_kode',
            'kategori_nama' => 'required|string|max:100',
        ]);

        KategoriModel::create($request->all());

        return redirect('kategori')->with('success', 'Data Kategori berhasil disimpan');
    }

    public function show($id)
    {
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Kategori'
        ];

        return view('kategori.show', compact('breadcrumb', 'page', 'kategori'));
    }

    public function edit($id)
    {
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Kategori',
            'list' => ['Home',  'Kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Kategori'
        ];

        return view('kategori.index', compact('breadcrumb', 'page', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_kode' => 'required|string|min:3|unique:m_kategori,kategori_kode,' . $id . ',kategori_id',
            'kategori_nama' => 'required|string|max:100',
        ]);

        $kategori = KategoriModel::find($id);
    
        $kategori->update($request->all());
        
        return redirect('kategori')->with('success', "Data Kategori berhasil diubah");
    }

    public function destroy($id)
    {
        $kategori = KategoriModel::find($id);

        if ($kategori) {
            $kategori->delete();
            return redirect('kategori')->with('success', 'Data Kategori berhasil dihapus');
        } else {
            return redirect('kategori')->with('error', 'Data Kategori gagal dihapus / tidak ada');
        }
    }
}
