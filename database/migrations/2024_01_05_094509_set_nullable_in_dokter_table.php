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
        Schema::table('dokter', function (Blueprint $table) {
            $table->string('alamat')->nullable()->change();
            $table->string('no_hp')->nullable()->change();
            $table->unsignedBigInteger('id_poli')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokter', function (Blueprint $table) {
            $table->string('alamat')->nullable(false)->change();
            $table->string('no_hp')->nullable(false)->change();
            $table->unsignedBigInteger('id_poli')->nullable(false)->change();
        });
    }
};
