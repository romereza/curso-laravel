<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//
		\MerezaProject\Entities\Client::truncate();
		factory(\MerezaProject\Entities\Client::class, 10)->create();
	}
}
