<?php

use Illuminate\Database\Seeder;

class ProjectMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    \MerezaProject\Entities\ProjectMembers::truncate();
	    factory(\MerezaProject\Entities\ProjectMembers::class, 30)->create();
    }
}
