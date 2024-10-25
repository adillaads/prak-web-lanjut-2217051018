<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jurusan')->insert([
            ['nama_jurusan' => 'Ilmu Komputer'],
            ['nama_jurusan' => 'Matematika'],
            ['nama_jurusan' => 'Fisika'],
            ['nama_jurusan' => 'Biologi'],
        ]);
    }
}
