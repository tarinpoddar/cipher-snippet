<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Users table
		Schema::create('users', function($table) {
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('name');
			$table->boolean('remember_token');
			$table->string('password');
			$table->timestamps();
		});

		// Create Snippets table
		Schema::create('snippets', function($table) {

			# AI, PK
			$table->increments('id');

			# Foreign key - connecting it to users
			$table->integer('user_id')->unsigned();

			# created_at, updated_at columns
			$table->timestamps();

			# Columns
			$table->string('title');
			$table->string('language');
			$table->text('code');

			# Define foreign keys...
			$table->foreign('user_id')->references('id')->on('users');

		});

		# Create the tags table
		Schema::create('tags', function($table) {

			# AI, PK
			$table->increments('id');

			# created_at, updated_at columns
			$table->timestamps();

			# Column for name of the tag
			$table->string('name');

		});

		# Create pivot table connecting `snippets` and `tags`
		Schema::create('snippet_tag', function($table) {

			# Columns
			$table->integer('snippet_id')->unsigned();
			$table->integer('tag_id')->unsigned();

			# Define foreign keys...
			$table->foreign('snippet_id')->references('id')->on('snippets');
			$table->foreign('tag_id')->references('id')->on('tags');

		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
		Schema::drop('snippets');
		Schema::drop('tags');
		Schema::drop('snippet_tag');
	}

}
