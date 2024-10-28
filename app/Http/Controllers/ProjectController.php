<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Menampilkan daftar proyek
    public function index(Request $request)
    {
        // $projects = Project::query();
        $search = $request->input('search');
        
        $projects = Project::when($search, function ($query, $search) {
                $query->where('nama_project', 'like', '%' . $search . '%');
            })
            ->orderBy('nama_project', 'asc')
            ->get();

        return view('projects.index', compact('projects'));
    }

    // Menampilkan form untuk membuat proyek baru
    public function create()
    {
        return view('projects.create');
    }

    // Menyimpan proyek baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_project' => 'required|string|max:255',
            'deskripsi_project' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status_project' => 'required|in:pending,in progress,completed',
        ]);

        Project::create([
            'nama_project' => $request->nama_project,
            'deskripsi_project' => $request->deskripsi_project,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status_project' => $request->status_project,
        ]);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dibuat.');
    }

    // Menampilkan detail proyek
    public function show(Project $project)
    {

        return view('projects.show', compact('project'));
    }

    // Menampilkan form untuk mengedit proyek
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    // Memperbarui proyek di database
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'nama_project' => 'required|string|max:255',
            'deskripsi_project' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status_project' => 'required|in:pending,in progress,completed',
        ]);

        $project->update([
            'nama_project' => $request->nama_project,
            'deskripsi_project' => $request->deskripsi_project,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status_project' => $request->status_project,
        ]);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    // Menghapus proyek dari database
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dihapus.');
    }
}
