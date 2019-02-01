<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_answer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->unsignedInteger('anon_answer_id');
            $table->foreign('anon_answer_id')
                    ->references('id')->on('anon_answers')
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
        Schema::dropIfExists('comment_answers');
    }
}
