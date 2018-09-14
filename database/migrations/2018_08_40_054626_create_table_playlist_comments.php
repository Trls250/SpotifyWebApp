<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePlaylistComments extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('playlist_comments', function(Blueprint $table) {

            $table->increments('id');
            $table->string('playlist_id', 30);
            $table->string('user_id', 30);
            $table->string('track_id', 30);
            $table->string('user_name', 30);
            $table->text('comment');
            $table->string('user_url', 255);
            $table->timestamps();
            $table->foreign('playlist_id')->references('id')->on('playlists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('playlist_comments');
    }

}
