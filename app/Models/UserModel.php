<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'user'; // The name of your database table

    protected $guarded = ['id']; // Fields that are not mass assignable

    protected $fillable = [
        'nama',     // User's name
        'npm',      // Student number
        'kelas_id', // Foreign key referencing Kelas
        'foto',     // Path to the user's photo
    ];

    // Retrieve user(s) with optional ID
    public function getUser($id = null) {
        if ($id != null) {
            // Get a specific user by ID with associated class name
            return $this->join('kelas', 'kelas.id', '=', 'user.kelas_id')
                ->select('user.*', 'kelas.nama_kelas')
                ->where('user.id', $id)
                ->first(); // Return the first matching record
        }

        // Get all users with associated class name, ordered by ID
        return $this->join('kelas', 'kelas.id', '=', 'user.kelas_id')
            ->select('user.*', 'kelas.nama_kelas as nama_kelas')
            ->orderBy('user.id', 'asc') // Order by user ID in ascending order
            ->get(); // Return all records
    }

    // Define the relationship to the Kelas model
    public function kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id'); // Foreign key relationship
    }
}
