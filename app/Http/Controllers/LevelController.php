<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;

class LevelController extends Controller
{
    public function index() 
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar Level Pengguna'
        ];

        return view('level.index', compact('breadcrumb', 'page'));
    }

    public function list()
    {
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');

        return DataTables::of($levels)->addIndexColumn()->addColumn('aksi', function ($level) {  
            $btn  = '<a href="'.url('/level/' . $level->level_id). '" class="btn btn-info btn-sm mx-1">Detail</a>';
            $btn .= '<a href="'.url('/level/' . $level->level_id . '/edit') . '"class="btn btn-warning btn-sm mx-1">Edit</a>';
            $btn .= '<form class="d-inline-block" method="POST" action="' . url('/level/'.$level->level_id).'">' . csrf_field() . method_field('DELETE') . 
                        '<button type="submit" class="btn btn-danger btn-sm mx-1" onclick="return confirm(\'Apakah Anda yakin menghapus data ini ?\');">Hapus</button>
                    </form>';
            return $btn;
        })->rawColumns(['aksi'])->make(true);
    }

    public function create() 
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Level Baru'
        ];

        return view('level.create', compact('breadcrumb', 'page'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:100',
        ]);

        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Data Level berhasil disimpan');
    }

    public function show($id)
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Level'
        ];

        return view('level.show', compact('breadcrumb', 'page', 'level'));
    }

    public function edit($id)
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list' => ['Home',  'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Level'
        ];

        return view('level.edit', compact('breadcrumb', 'page', 'level'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode,' . $id . ',level_id',
            'level_nama' => 'required|string|max:100',
        ]);

        LevelModel::find($id)->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);
        
        return redirect('/level')->with('success', "Data Level berhasil diubah");
    }

    public function destroy($id)
    {
        $check = LevelModel::find($id);

        if (!$check) {
            return redirect('/level')->with('error', 'Data Level tidak ditemukan');
        }
        
        try {
            LevelModel::destroy($id);
            return redirect('/level')->with('success', 'Data Level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/level')->with('error', 'Data Level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
