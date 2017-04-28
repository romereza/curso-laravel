<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(MerezaProject\Entities\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'status' => $faker->randomElement(["1", "0"]),
        'remember_token' => str_random(10),
    ];
});

$factory->define(MerezaProject\Entities\Client::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->name,
		'responsible' => $faker->name,
		'email' => $faker->email,
		'phone' => $faker->phoneNumber,
		'address' => $faker->address,
		'obs' => $faker->sentence,
	];
});

$factory->define(MerezaProject\Entities\Project::class, function (Faker\Generator $faker) {
//	$faker->word(10);

	$owner = $faker->randomElement(\MerezaProject\Entities\User::all('id')->toArray());
	$client = $faker->randomElement(\MerezaProject\Entities\Client::all('id')->toArray());

	return [
		'owner_id' => $owner["id"],
		'client_id' => $client["id"],
		'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
		'description' => $faker->paragraph,
		'progress' => rand(0,100),
		'status' => rand(1,3),
		'due_date' => $faker->dateTimeBetween("now", "+5 month"),
	];
});

$factory->define(MerezaProject\Entities\ProjectNote::class, function (Faker\Generator $faker) {
//	$faker->word(10);

	$project = $faker->randomElement(\MerezaProject\Entities\Project::all('id')->toArray());

	return [
		'project_id' => $project["id"],
		'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
		'note' => $faker->paragraph,
	];
});

$factory->define(MerezaProject\Entities\ProjectTask::class, function (Faker\Generator $faker) {
//	$faker->word(10);

	$project = $faker->randomElement(\MerezaProject\Entities\Project::all('id')->toArray());

	return [
		'project_id' => $project["id"],
		'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
		'start_date' => $faker->dateTimeBetween("now", "+1 month"),
		'due_date' => $faker->dateTimeBetween("+1 month", "+2 month"),
		'status' => rand(1,3),
	];
});