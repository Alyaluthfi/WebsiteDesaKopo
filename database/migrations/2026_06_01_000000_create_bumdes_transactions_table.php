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
        Schema::create('bumdes_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('bumdes_id')->nullable()->constrained('bumdes')->onDelete('set null');
            $table->string('bumdes_slug');
            $table->string('bumdes_name');
            $table->string('nama_pembeli');
            $table->string('email');
            $table->string('no_hp');
            $table->text('kebutuhan');
            $table->string('status')->default('menunggu'); // menunggu, habis, di proses, sudah siap, selesai
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bumdes_transactions');
    }
};
