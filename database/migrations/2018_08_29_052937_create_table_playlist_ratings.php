<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePlaylistRatings extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('playlist_ratings', function(Blueprint $table) {

            $table->increments('id');
            $table->string('playlist_id', 60);
            $table->string('user_id', 60);
            $table->unique(['playlist_id', 'user_id']);
            $table->unsignedInteger('rating');
            $table->foreign('playlist_id')->references('id')->on('playlists')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('Playlist_ratings');
    }

}
