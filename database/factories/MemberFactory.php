<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cities;
use App\Department;
use App\Districts;
use App\Member;
use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Member::class, function (Faker $faker) {
    return [
        'full_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('123456'), // password
        'gender' => random_int(1, 2),
        'avatar' => '/images//62f3111853e68-bongda.jpg',
        'tinh' => Cities::all()->random()->id,
        'huyen' => Districts::all()->random()->id,
        'address' =>$faker->address(),
        'status' => random_int(1, 2),
        'role' => random_int(1, 2),
        'brith_date' => $faker->date(),
        'department_id' => Department::all()->random()->id,
        'phone' => $faker->phoneNumber(),
    ];
});
