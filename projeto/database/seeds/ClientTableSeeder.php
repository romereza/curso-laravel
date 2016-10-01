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
		\MerezaProject\Client::truncate();
		factory(\MerezaProject\Client::class, 10)->create();
    }
}
