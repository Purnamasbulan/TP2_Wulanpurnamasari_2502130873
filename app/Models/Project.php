<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_project',
        'deskripsi_project',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_project',
    ];

    // Relasi dengan model Task
    public function tasks()
    {
        return $this->hasMany(Task::class); // Menghubungkan dengan model Task
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }
}
