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
		'name' => $faker->name,
		'description' => $faker->sentence,
		'progress' => $faker->randomElement(["Aberto", "Em andamento", "Em espera", "Finalizado"]),
		'status' => $faker->randomElement(["1", "0"]),
		'due_date' => $faker->dateTimeBetween("now", "+5 month"),
	];
});
