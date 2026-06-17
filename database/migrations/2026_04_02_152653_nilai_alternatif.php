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
        //
        Schema::create('nilai_alternatif', function (Blueprint $table) {
            $table->id('id_nilai');
            $table->foreignId('id_motor')
                ->constrained('motor_listrik', 'id_motor')
                ->cascadeOnDelete();
            $table->foreignId('id_kriteria')
                ->constrained('criterias', 'id_kriteria')
                ->cascadeOnDelete();
            $table->decimal('nilai', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('nilai_alternatif');
    }
};
