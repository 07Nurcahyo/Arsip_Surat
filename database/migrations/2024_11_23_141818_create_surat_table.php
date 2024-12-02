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
        Schema::create('surat', function (Blueprint $table) {
            $table->id('id_surat');
            $table->string('nomor_surat', 25)->unique();
            $table->string('judul_surat', 200);
            $table->string('file_surat', 200);
            $table->unsignedBigInteger('kode_kategori')->index(); //fk
            $table->timestamps();

            $table->foreign('kode_kategori')->references('id_kategori')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
