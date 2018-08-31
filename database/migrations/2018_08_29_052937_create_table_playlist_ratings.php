<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePlaylistRatings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Playlist_ratings', function(Blueprint $table){

            $table->string('playlist_id', 30);
            $table->string('user_id', 30);
            $table->unique(['playlist_id', 'user_id']);
            $table->unsignedInteger('rating');
            $table->foreign('playlist_id')->references('id')->on('playlists');
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
        Schema::drop('Playlist_ratings');
    }

}
