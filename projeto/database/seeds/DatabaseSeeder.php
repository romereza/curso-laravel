<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		Eloquent::unguard();

		//disable foreign key check for this connection before running seeders
		\Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		$this->call(UserTableSeeder::class);
		$this->call(ClientTableSeeder::class);
		$this->call(ProjectTableSeeder::class);

		// supposed to only apply to a single connection and reset it's self
		// but I like to explicitly undo what I've done for clarity
		\Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

	}
}
