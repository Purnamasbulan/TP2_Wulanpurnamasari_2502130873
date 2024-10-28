<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectUserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil project berdasarkan project_id dari request
        $project = Project::findOrFail($request->project_id);

        // Memuat relasi 'users' secara langsung
        $project->load('users');

        // Mengarahkan ke view dengan data pengguna terkait proyek
        return view('projects.user', compact('project'));
    }

    // Menampilkan form tambah user ke project
    public function create(Request $request)
    {
        // Ambil project berdasarkan project_id dari request
        $project = Project::findOrFail($request->project_id);

        // Ambil daftar user dengan role "user" yang belum terkait dengan proyek ini
        $availableUsers = User::where('role', 'user')
            ->whereDoesntHave('projects', function ($query) use ($project) {
                $query->where('projects.id', $project->id);
            })->get();
    
        return view('projects.add-user', compact('project', 'availableUsers'));
    }    

    // Menyimpan user yang ditambahkan ke project
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
        ]);

        // Ambil project berdasarkan project_id dari request
        $project = Project::findOrFail($request->project_id);

        ProjectUser::create([   
            'project_id' => $project->id,
            'user_id' => $request->user_id,
        ]);
    
        return redirect()->route('projectsUser.index', ['project_id' => $project->id])->with('success', 'User berhasil ditambahkan ke proyek.');
    }

    public function destroy(Request $request, $id)
    {
        // Temukan record ProjectUser berdasarkan ID
        $projectUser = ProjectUser::findOrFail($id);
        
        // Hapus record
        $projectUser->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus dari proyek.');
    }
}
