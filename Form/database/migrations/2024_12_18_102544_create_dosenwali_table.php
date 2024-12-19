<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dosenwali', function (Blueprint $table) {
            $table->id(); // Primary key auto increment
            $table->string('nip_dosen'); // Foreign key ke tabel dosen
            $table->string('nim_mahasiswa'); // Foreign key ke tabel mahasiswa
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('nip_dosen')->references('nip')->on('dosen')->onDelete('cascade');
            $table->foreign('nim_mahasiswa')->references('nim')->on('mahasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosenwali');
    }
};
