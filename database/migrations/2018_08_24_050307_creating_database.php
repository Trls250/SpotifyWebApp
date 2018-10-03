<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatingDatabase extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('playlists', function(Blueprint $table) {

            $table->string('id', 60)->primary();
            $table->string('title', 255);
            $table->string('repeated_artist', 255);
            $table->string('repeated_artist_id', 60);
            $table->string('added_by', 60);
            $table->string('added_by_name', 255);
            $table->string('creator_name', 255)->nullable();
            $table->string('creator_id', 60);
            $table->unsignedInteger('rating')->nullable();
            $table->unsignedInteger('followers')->nullable();
            $table->unsignedInteger('popularity')->nullable();
            $table->unsignedInteger('instrumentalness')->nullable();
            $table->unsignedInteger('liveness')->nullable();
            $table->Integer('loudness')->nullable();
            $table->unsignedInteger('speechiness')->nullable();
            $table->unsignedInteger('tempo')->nullable();
            $table->unsignedInteger('danceability')->nullable();
            $table->unsignedInteger('energy')->nullable();
            $table->unsignedInteger('acousticness')->nullable();
            $table->unsignedInteger('valence')->nullable();
            $table->unsignedInteger('total_tracks')->nullable();
            $table->unsignedInteger('calculated_tracks')->nullable();
            $table->boolean('cover')->default(false);
            $table->unsignedInteger('rating_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('playlists');
    }

}
