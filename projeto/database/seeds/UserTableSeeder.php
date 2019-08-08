<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		\MerezaProject\Entities\User::truncate();
		factory(\MerezaProject\Entities\User::class)->create([
			'name' => "Romero Araujo",
			'email' => "romereza@gmail.com",
			'password' => bcrypt('123456'),
			'status' => 1,
			'remember_token' => str_random(10),
		]);
		factory(\MerezaProject\Entities\User::class, 5)->create();
    }
}
