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
        Schema::create('motor_listrik', function (Blueprint $table) {
            $table->id('id_motor');
            $table->string('nama_motor');
            $table->integer('harga');
            $table->integer('jarak_tempuh');
            $table->integer('waktu_pengisian');
            $table->decimal('kapasitas_baterai', 8, 2);
            $table->decimal('daya_maksimum', 8, 2);
            $table->foreignId('created_by')
                ->constrained('users','id')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('motor_listrik');
    }
};
