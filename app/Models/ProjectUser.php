<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectUser extends Pivot
{
    protected $table = 'project_user';

    // Jika ingin timestamps otomatis, hapus baris ini
    public $timestamps = false;

    // Atur kolom yang bisa diisi
    protected $fillable = ['user_id', 'project_id'];
}
