<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel soal
        Schema::create('soal', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori_soal', ['CLASSICAL', 'KELOMPOK', 'MANDIRI']);
            $table->enum('type', ['PILIHAN GANDA', 'ESAY']);
            $table->text('value'); // Pertanyaan
            $table->json('options'); // Pilihan jawaban
            $table->timestamps();
        });

        // Tabel jawaban
        Schema::create('jawaban', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama peserta
            $table->foreignId('soal_id') // Relasi ke tabel soal
                ->constrained('soal')
                ->onDelete('cascade');
            $table->string('jawaban')->nullable(); // Jawaban peserta
            $table->boolean('ragu_ragu'); // Status ragu-ragu
            $table->timestamps();

            // Tambahkan constraint UNIQUE untuk nama dan soal_id
            $table->unique(['nama', 'soal_id'], 'jawaban_nama_soal_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban'); // Hapus tabel jawaban terlebih dahulu
        Schema::dropIfExists('soal'); // Hapus tabel soal
    }
};
