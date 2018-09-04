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
        Schema::create('Playlists', function(Blueprint $table) {
            $table->string('id', 30)->primary();
            $table->string('title', 255);
            $table->string('repeated_artist', 255);
            $table->string('repeated_artist_id', 30);
            $table->string('added_by', 30);
            $table->string('creator_name', 255)->nullable();
            $table->string('creator_id', 30);
            $table->unsignedDecimal('rating')->nullable();
            $table->unsignedInteger('followers')->nullable();
            $table->unsignedDecimal('popularity')->nullable();
            $table->unsignedDecimal('danceability')->nullable();
            $table->unsignedDecimal('energy')->nullable();
            $table->unsignedDecimal('valence')->nullable();
            $table->unsignedInteger('total_tracks')->nullable();
            $table->unsignedInteger('calculated_tracks')->nullable();
            $table->boolean('cover')->default(false);
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
