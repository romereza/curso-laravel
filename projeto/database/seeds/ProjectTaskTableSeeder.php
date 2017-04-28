<?php

use Illuminate\Database\Seeder;

class ProjectTaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		\MerezaProject\Entities\ProjectTask::truncate();
		factory(\MerezaProject\Entities\ProjectTask::class, 50)->create();
    }
}
