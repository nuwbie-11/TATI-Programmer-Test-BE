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

        Schema::create('daily_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->enum('is_pending',['yes','no'])->default('no');
            $table->enum('is_approved',['yes','no'])->default('no');
            $table->enum('is_rejected',['yes','no'])->default('no');
            $table->enum('is_active',['yes','no'])->default('no');
            $table->timestamp('log_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_logs');
    }
};
