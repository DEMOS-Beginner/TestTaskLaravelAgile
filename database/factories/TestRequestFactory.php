<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\TestRequest::class, function (Faker $faker) {
	$subject = $faker->sentence(rand(3,8), /**VariableNbWords:*/true);
	$text = $faker->realText(rand(1000,4000));
	$createdAt = $faker->dateTimeBetween('-3 months', '-2 days');

	$data = [
		'user_id'    => 2,
		'subject'    => $subject,
		'text'       => $text,
		'created_at' => $createdAt,
		'updated_at' => $createdAt,
		'status'     => 0,
	];

	return $data;
});
