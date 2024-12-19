<?php

namespace Database\Seeders;

use App\Models\Mata_Kuliah;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call(userseeder::class);
       $this->call(fakultasseeder::class);
       $this->call(prodiseeder::class);
       $this->call(dosenseeder::class);
       $this->call(mhsseeder::class);
       $this->call(matakuliahseeder::class);
       $this->call(ruangkuliahseeder::class);
       $this->call(jadwalkuliahseeder::class);
       $this->call(bakaseeder::class);
       $this->call(dosen_mkseeder::class);
       $this->call(kelasseeder::class);
       $this->call(irsseeder::class);
       $this->call(khsseeder::class);
       $this->call(DosenWaliSeeder::class);

    }
}