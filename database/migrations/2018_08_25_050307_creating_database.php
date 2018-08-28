<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatingDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Playlists', function(Blueprint $table)
        {
            $table->string('id',30)->primary();
            $table->string('title',255);
            $table->string('creator_name',255);
            $table->string('creator_id',30);
            $table->date('submitted');
            $table->unsignedDecimal('rating');
            $table->unsignedInteger('followers');
            $table->unsignedDecimal('popularity');
            $table->unsignedDecimal('danceability');
            $table->unsignedDecimal('energy');
            $table->unsignedDecimal('valence');




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('playlists');
    }

}
