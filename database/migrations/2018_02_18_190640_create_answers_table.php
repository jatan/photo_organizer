<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_Id');
            $table->tinyInteger('frame_status');
            $table->tinyInteger('photo_type');
            $table->boolean('me')->nullable();
            $table->boolean('wife')->nullable();
            $table->boolean('kids')->nullable();
            $table->boolean('parents')->nullable();
            $table->boolean('pets')->nullable();
            $table->boolean('food')->nullable();
            $table->boolean('randoms')->nullable();
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
        Schema::dropIfExists('answers');
    }
}
