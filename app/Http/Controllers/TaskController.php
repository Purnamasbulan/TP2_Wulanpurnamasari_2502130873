<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Menampilkan daftar tugas untuk proyek tertentu
    public function index($projectId)
    {
        $project = Project::findOrFail($projectId);
    
        // Ambil query pencarian jika ada
        $search = request()->query('search');
    
        // Ambil tugas dengan opsi pencarian
        $tasks = $project->tasks()
            ->when($search, function ($query, $search) {
                return $query->where('nama_tugas', 'like', '%' . $search . '%');
            })
            ->paginate(10); // Atur jumlah tugas per halaman sesuai kebutuhan
    
        return view('tasks.index', compact('project', 'tasks'));
    }
    

    // Menampilkan form untuk menambahkan tugas baru
    public function create(Request $request)
    {
        $project = Project::findOrFail($request->project_id);
        return view('tasks.create', compact('project'));
    }

    // Menyimpan tugas baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'nama_tugas' => 'required|string|max:255',
            'deskripsi_tugas' => 'nullable|string',
            'status_tugas' => 'required|in:pending,in progress,completed',
            'tanggal_deadline' => 'nullable|date',
        ]);

        Task::create([
            'project_id' => $request->project_id,
            'nama_tugas' => $request->nama_tugas,
            'deskripsi_tugas' => $request->deskripsi_tugas,
            'status_tugas' => $request->status_tugas,
            'tanggal_deadline' => $request->tanggal_deadline,
        ]);

        return redirect()->route('projects.show', $request->project_id)
                         ->with('success', 'Tugas berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit tugas
    public function edit(Task $task)
    {
        $project = $task->project; // Mengambil proyek terkait tugas
        return view('tasks.edit', compact('task', 'project'));
    }

    // Mengupdate tugas di dalam database
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'nama_tugas' => 'required|string|max:255',
            'deskripsi_tugas' => 'nullable|string',
            'status_tugas' => 'required|in:pending,in progress,completed',
            'tanggal_deadline' => 'nullable|date',
        ]);

        $task->update([
            'nama_tugas' => $request->nama_tugas,
            'deskripsi_tugas' => $request->deskripsi_tugas,
            'status_tugas' => $request->status_tugas,
            'tanggal_deadline' => $request->tanggal_deadline,
        ]);

        return redirect()->route('projects.show', $task->project_id)
                         ->with('success', 'Tugas berhasil diperbarui.');
    }

    // Menghapus tugas dari database
    public function destroy(Task $task)
    {
        $projectId = $task->project_id; // Menyimpan ID proyek sebelum menghapus
        $task->delete();

        return redirect()->route('projects.show', $projectId)
                         ->with('success', 'Tugas berhasil dihapus.');
    }
}
