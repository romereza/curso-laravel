<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		\MerezaProject\Entities\Project::truncate();
		factory(\MerezaProject\Entities\Project::class, 10)->create();
    }
}
