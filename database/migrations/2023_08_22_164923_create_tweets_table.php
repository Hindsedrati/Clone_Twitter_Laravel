<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->index('uuid');
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->string('image')->nullable();
            $table->string('handle');
            $table->text('tweet');
            $table->string('file')->nullable();
            $table->boolean('is_video')->nullable()->default(false);
            $table->string('comments')->nullable();
            $table->string('retweets')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweets');
    }
};
