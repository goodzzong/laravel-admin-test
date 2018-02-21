<?php

use Faker\Generator as Faker;
use Faker\Factory;
use App\Support\KoreanLoremProvider;
use App\Notice;

$faker = Factory::create('ko_KR');
$koreanProvider = new KoreanLoremProvider($faker);
$faker->addProvider($koreanProvider);

$factory->define(App\Notice::class, function () use ($faker) {

    $user = random_int(1, 2);
    $rank = Notice::count();
    return [
        'user_id' => 1,
        'title' => $faker->korSentence(),
        'content' => $faker->korSentence(),
        'rank' => $rank,
        'released' => 1,
    ];
});
