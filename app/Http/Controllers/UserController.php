<?php

namespace App\Http\Controllers;

use App\Models\UserModel as ModelsUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() 
    {
        // // Coba akses model UserModel
        // $user = ModelsUserModel::all(); // Ambil semua data dari tabel m_user
        // return view('user', ['data'=>$user]);

        // Menambahkan data menggunkan ORM
        // $data = [
        //     'username' => 'Dika',
        //     'nama' => 'Dika',
        //     'password' => Hash::make('1234'),
        //     'user_id' => 4,
        //     'level_id' => 1,
        // ];
        // ModelsUserModel::insert($data);

        // Update data
        // $data = [
        //     'nama' => "Anton"
        // ];
        // ModelsUserModel::where('username', 'Dika')->update($data);

        // Delete data
        ModelsUserModel::where('username', 'Dika')->delete();

        // Akses UserModel
        $user = ModelsUserModel::all();
        return view('user', ['data'=>$user]);
    }
}
