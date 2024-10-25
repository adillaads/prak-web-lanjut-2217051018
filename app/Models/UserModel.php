<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'user';
    protected $guarded = ['id'];

    protected $fillable = [
        'nama',
        'npm',
        'kelas_id',
        'jurusan_id',
        'foto',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    public function getUser($id = null)
    {
        $query = $this->join('kelas', 'kelas.id', '=', 'user.kelas_id')
            ->join('jurusan', 'jurusan.id', '=', 'user.jurusan_id')
            ->join('fakultas', 'fakultas.id', '=', 'jurusan.fakultas_id')
            ->select('user.*', 'kelas.nama_kelas', 'jurusan.nama_jurusan', 'fakultas.nama_fakultas');

        if ($id != null) {
            return $query->where('user.id', $id)->first();
        } else {
            return $query->orderBy('user.id', 'asc')->get(); // Urutkan dari yang paling lama ke yang terbaru
        }
    }
}
