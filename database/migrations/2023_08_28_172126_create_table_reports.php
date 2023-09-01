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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_uuid')->index('report_uuid');
            $table->unsignedBigInteger('report_user_id')->index('report_user_id');
            $table->string('tweet_uuid')->index('tweet_uuid');
            $table->foreign(['report_user_id'], 'reports_ibfk_1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['tweet_uuid'], 'reports_ibfk_2')->references(['uuid'])->on('tweets')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->unsignedBigInteger('user_id')->index('user_id')->nullable();
            $table->foreign(['user_id'], 'reports_ibfk_3')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
