<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherTagsPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_other_tags', function(Blueprint $table) {

            $table->string('playlist_id', 60);
            $table->foreign('playlist_id')->references('id')->on('playlists');
            $table->unsignedInteger('other_tag_id');
            $table->foreign('other_tag_id')->references('id')->on('other_tags');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::drop('other_tags');
    }
}
