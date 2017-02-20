<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePdetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pdetails', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->string('merchantid');
                        $table->string('merchantkey');
                        $table->string('responseposted');
                        $table->string('responseurl');
                        $table->string('cancelurl');
                        $table->string('merchantip');
                        $table->string('merchantsec');
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
		Schema::drop('pdetails');
	}

}
