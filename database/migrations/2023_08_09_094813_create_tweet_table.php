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
        Schema::create('tweets', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->text('tweet');
            $table->string('file')->nullable();
            $table->boolean('is_video')->nullable()->default('0');
            $table->string('comments')->default('0');
            $table->string('retweets')->default('0');
            $table->string('likes')->default('0');
            $table->string('analytics')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tweets');
    }
};