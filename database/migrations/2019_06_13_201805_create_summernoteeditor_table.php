<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSummernoteeditorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {

        Schema::create('summernotes', function (Blueprint $table) {

            $table->increments('id');

            $table->longText('content');

            $table->string('feature');

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

        Schema::dropIfExists('summernotes');

    }
}
