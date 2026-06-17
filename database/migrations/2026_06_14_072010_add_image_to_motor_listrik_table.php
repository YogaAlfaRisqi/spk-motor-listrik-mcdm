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
        Schema::table('motor_listrik', function (Blueprint $table) {
            //
            Schema::table('motor_listrik', function (Blueprint $table) {
                $table->string('image')->nullable()->after('daya_maksimum');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('motor_listrik', function (Blueprint $table) {
            //
            Schema::table('motor_listrik', function (Blueprint $table) {
                $table->string('image')->nullable()->after('daya_maksimum');
            });
        });
    }
};
