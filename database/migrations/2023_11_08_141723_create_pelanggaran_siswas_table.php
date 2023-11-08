<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('pelanggaran_siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id')->nullable();
            $table->foreign('siswa_id')->references('id')->on('siswa');
            $table->date('tanggal');
            $table->unsignedBigInteger('pelanggaran_id')->nullable();
            $table->foreign('pelanggaran_id')->references('id')->on('master_pelanggaran');
            $table->unsignedBigInteger('sanksi_id')->nullable();
            $table->foreign('sanksi_id')->references('id')->on('sanksi');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('user');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggaran_siswa');
    }
};
