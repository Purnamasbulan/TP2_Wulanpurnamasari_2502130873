<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('role', 'user') // Hanya ambil pengguna dengan role "user"
                      ->where('name', 'like', '%' . $search . '%') // Pencarian berdasarkan nama
                      ->get();
    
        return view('users.index', compact('users'));
    }
}
