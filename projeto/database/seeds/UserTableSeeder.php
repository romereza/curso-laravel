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
		factory(\MerezaProject\Entities\User::class, 5)->create();
    }
}
