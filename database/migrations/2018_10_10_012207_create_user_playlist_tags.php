<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPlaylistTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_user', function(Blueprint $table) {

            $table->string('user_id', 60);
            $table->string('playlist_id', 60);
            $table->primary(['user_id', 'playlist_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('playlist_id')->references('id')->on('playlists');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('plalist_user');
    }
}
