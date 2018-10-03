<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistDatabse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {

            $table->string('id', 30);
            $table->string('name', 30)->nullable();
            $table->unsignedInteger('followers');
            $table->unsignedDecimal('popularity');
            $table->primary('id');


    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('artists');
    }
}
