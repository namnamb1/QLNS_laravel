<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Member;
use App\MemberLeave;
use App\Model;
use Faker\Generator as Faker;

$factory->define(MemberLeave::class, function (Faker $faker) {
    return [
        'member_id' => Member::all()->random()->id,
        'date_leave' => $faker->dateTimeBetween('-1 year', 'now'),
    ];
});
