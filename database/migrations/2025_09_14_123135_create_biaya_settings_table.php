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
        Schema::create('biaya_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('keamanan')->default(0);
            $table->integer('kebersihan')->default(0);
            $table->date('tanggal_tagih')->nullable(); // tanggal mulai tagihan
            $table->date('tanggal_jatuh_tempo')->nullable(); // tanggal jatuh tempo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biaya_settings');
    }
};
