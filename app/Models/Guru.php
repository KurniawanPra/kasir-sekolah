<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';

    protected $fillable = [
        'nama_guru',
        'nip',
        'jabatan',
        'mata_pelajaran',
        'no_hp',
        'email',
        'alamat',
        'status',
        'foto',
    ];

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'guru_id');
    }
}
