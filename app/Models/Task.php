<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Tentukan atribut yang bisa diisi
    protected $fillable = [
        'project_id',
        'nama_tugas',
        'deskripsi_tugas',
        'status_tugas',
        'tanggal_deadline',
    ];

    // Relasi dengan model Project
    public function project()
    {
        return $this->belongsTo(Project::class); // Menghubungkan kembali ke model Project
    }
}
