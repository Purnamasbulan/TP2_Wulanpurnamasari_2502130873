<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function show(Request $request)
    {
        // Mengambil ID proyek dari request
        $project = Project::findOrFail($request->project_id);
        
        // Menghitung total dan selesai tugas
        $totalTasks = $project->tasks->count();
        $completedTasks = $project->tasks->where('status_tugas', 'completed')->count();
        $progressPercentage = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
    
        return view('progress', compact('project', 'progressPercentage'));
    }
}
