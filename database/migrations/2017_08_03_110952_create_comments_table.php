<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('created_at');
            $table->integer('user_id')->unsigned();
            $table->integer('contractor_id')->unsigned();
            $table->text('comments');
            $table->integer('reminder');
            $table->date('date_reminder');
            $table->integer('reminder_status');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('contractor_id')->references('id')->on('contractors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
