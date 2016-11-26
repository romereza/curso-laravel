<?php

use Illuminate\Database\Seeder;

class ProjectNoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		\MerezaProject\Entities\ProjectNote::truncate();
		factory(\MerezaProject\Entities\ProjectNote::class, 50)->create();
    }
}
