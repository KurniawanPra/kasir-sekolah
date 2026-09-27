<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = [
        'nama',
        'guru_id'
    ];

    public function guru(){
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function siswa(){
        return $this->hasMany(Siswa::class, 'guru_id');
    }
}
