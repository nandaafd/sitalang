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
        Schema::create('token', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('token')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->boolean('is_expired')->default(0)->nullable();
            $table->string('used_for')->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token');
    }
};
