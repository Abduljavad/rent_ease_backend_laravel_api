<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('properties', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name');
			$table->integer('bhk')->nullable();
			$table->text('location')->nullable();
			$table->json('desc')->nullable();
			$table->decimal('price')->nullable();
			$table->boolean('is_available')->default(1)->nullable();
			$table->string('thumbnail')->nullable();
			$table->json('images')->nullable();
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
		Schema::drop('properties');
	}
};
