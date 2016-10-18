<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		//Add active
		if (!Schema::hasColumn('users', 'status')) {
			Schema::table('users', function (Blueprint $table) {
				$table->tinyInteger('status')->default(0)->after('password');
			});
		}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Remove active
		if (!Schema::hasColumn('users', 'status')) {
			Schema::table('users', function (Blueprint $table) {
				$table->dropColumn('status');
			});
		}
    }
}
