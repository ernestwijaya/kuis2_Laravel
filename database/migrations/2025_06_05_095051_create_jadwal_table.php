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
        Schema::create('jadwal', function (Blueprint $table) {
             $table->uuid('id')->primary();
            $table->string('tahun_akademik', 10);
            $table->enum('kode_smt', ['Gasal', 'Genap'])->default('Gasal');
            $table->string('kelas', 50);
            $table->unsignedBigInteger('sesi_id');
            $table->uuid('mata_kuliah_id');
            $table->unsignedBigInteger('dosen_id');
            $table->foreign('sesi_id')->references('id')->on('sesi')->onDelete('cascade');
            $table->foreign('mata_kuliah_id')->references('id')->on('mata_kuliah')->onDelete('cascade');
            $table->foreign('dosen_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
