<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSyllablesAndPhonemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speech_words', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('pt_id');
            $table->string('word');
            $table->integer('score')->default(0);
            $table->timestamps();
        });
        Schema::create('syllables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('pt_id');
            $table->string('syllable');
            $table->integer('score')->default(0);
            $table->timestamps();
        });
        Schema::create('phonemes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('pt_id');
            $table->string('phoneme');
            $table->integer('score')->default(0);
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
        Schema::dropIfExists('speech_words');
        Schema::dropIfExists('syllables');
        Schema::dropIfExists('phonemes');
    }
}
