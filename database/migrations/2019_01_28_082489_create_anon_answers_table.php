<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnonAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anon_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('poll_id');
            $table->unsignedInteger('anon_id');

            $table->foreign('poll_id')
                ->references('id')->on('poll')
                ->onDelete('cascade');
            $table->unsignedInteger('answer_id');
            $table->foreign('answer_id')
                ->references('id')->on('answer')
                ->onDelete('cascade');
            $table->foreign('anon_id')
                            ->references('id')->on('anons')
                            ->onDelete('cascade');
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
        Schema::dropIfExists('anon_answers');
    }
}
