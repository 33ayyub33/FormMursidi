<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\DosenWali;

class DosenWaliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua NIP dosen yang memiliki role 'dosen' atau 'kaprodi'
        $dosenList = Dosen::whereIn('role', ['dosen', 'kaprodi'])->pluck('nip')->toArray();

        // Ambil semua NIM mahasiswa
        $mahasiswaList = Mahasiswa::pluck('nim')->toArray();

        // Buat perwalian mahasiswa ke dosen secara acak
        foreach ($mahasiswaList as $nim) {
            DosenWali::create([
                'nip_dosen' => $dosenList[array_rand($dosenList)], // Pilih dosen secara acak
                'nim_mahasiswa' => $nim,
            ]);
        }
    }
}
