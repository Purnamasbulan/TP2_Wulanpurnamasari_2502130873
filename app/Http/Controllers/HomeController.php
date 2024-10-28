<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function checkUpcomingDeadlines()
    {
        $now = Carbon::now();
        $deadlineThreshold = $now->copy()->addHours(36); // Set batas waktu 36 jam ke depan
        $userId = auth()->id(); // Mengambil ID pengguna saat ini
    
        $upcomingTasks = Task::whereHas('project', function ($query) use ($userId) {
                $query->whereHas('users', function ($query) use ($userId) {
                    $query->where('users.id', $userId); // Cek tugas yang terkait dengan pengguna saat ini
                });
            })
            ->where('tanggal_deadline', '>=', $now)
            ->where('tanggal_deadline', '<=', $deadlineThreshold)
            ->where('status_tugas', '!=', 'completed')
            ->get();
    
        return $upcomingTasks; // Ini akan digunakan untuk menampilkan alert
    }

    public function index()
    {
        $upcomingTasks = $this->checkUpcomingDeadlines();
        return view('home', compact('upcomingTasks'));
    }

}
