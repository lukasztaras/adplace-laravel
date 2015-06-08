<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Adverts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('adverts', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('title');
                $table->string('description');
                $table->string('city')->nullable();
                $table->string('color')->nullable();
                $table->string('hashtag')->nullable();
                $table->datetime('added');
                $table->datetime('expires');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('adverts');
	}

}
