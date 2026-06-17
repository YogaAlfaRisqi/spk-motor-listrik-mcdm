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
        Schema::create('hasil_rekomedasi', function (Blueprint $table) {
            $table->id('id_hasil');
            $table->foreignId('id_motor')
                ->constrained('motor_listrik', 'id_motor')
                ->cascadeOnDelete();
            $table->string('metode');
            $table->decimal('nilai_preferensi', 10, 6);
            $table->integer('rangking');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('hasil_rekomedasi');
    }
};
