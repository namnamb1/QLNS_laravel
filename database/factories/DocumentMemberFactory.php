<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Document;
use App\Member;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Document::class, function (Faker $faker) {
    $member = App\Member::pluck('id')->toArray();
    return [
        'member_id' => $faker->randomElement($member),
        'start_date' => $faker->date(),
        'end_date' => $faker->date(),
        'can_cuoc' => $faker->randomNumber,
        'papers' => '/images//62f730661f00a-ckeditor4-export-pdf (3).pdf',
        'cv_member' => '/images//62f730661f83c-ckeditor4-export-pdf (3).pdf',
        'contract' => '/images//62f730661f578-ckeditor4-export-pdf (3).pdf'

    ];
});
