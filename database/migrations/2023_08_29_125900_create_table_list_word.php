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
        Schema::create('list_word', function (Blueprint $table) {
            $table->id();
            $table->string('word');
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->foreign(['user_id'], 'reports_ibfk_3')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_word');
    }
};
