<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTopPlaylists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("user_top_playlists", function (Blueprint $table) {

            $table->increments('id');
            $table->string('user_id', 60);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('playlist_id', 60);
            $table->string('playlist_title', 60);
            $table->string('preview_url', 100);
            $table->unsignedInteger('followers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("user_top_playlists");
    }
}
