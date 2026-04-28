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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('kode_barang')->unique(); // Penting untuk identifikasi unik
            $table->string('nama_barang');
            $table->string('merk')->nullable();
            $table->integer('stok')->default(0);
            $table->enum('kondisi', ['Bagus', 'Rusak', 'Perlu Perbaikan'])->default('Bagus');
            $table->string('lokasi');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Be
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
