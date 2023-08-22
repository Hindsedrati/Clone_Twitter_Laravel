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
        Schema::table('analytics', function (Blueprint $table) {
            $table->foreign(['user_id'], 'analytics_ibfk_1')->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['tweet_uuid'], 'analytics_ibfk_2')->references(['uuid'])->on('tweets')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('analytics', function (Blueprint $table) {
            $table->dropForeign('analytics_ibfk_1');
            $table->dropForeign('analytics_ibfk_2');
        });
    }
};
