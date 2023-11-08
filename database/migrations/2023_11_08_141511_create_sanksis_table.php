<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('sanksi', function (Blueprint $table) {
            $table->id();
            $table->string('poin');
            $table->string('sanksi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sanksi');
    }
};
