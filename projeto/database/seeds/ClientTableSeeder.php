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
		\MerezaProject\Models\Client::truncate();
		factory(\MerezaProject\Models\Client::class, 10)->create();
    }
}
