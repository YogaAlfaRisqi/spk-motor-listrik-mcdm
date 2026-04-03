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
        Schema::create('criterias', function (Blueprint $table) {
            $table->id('id_kriteria');
            $table->string('kode_kriteria')->unique();
            $table->string('nama_kriteria');
            $table->text('keterangan')->nullable();
            $table->string('skala_penilaian')->nullable();
            $table->enum('tipe', ['benefit', 'cost']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criterias');
    }
};
