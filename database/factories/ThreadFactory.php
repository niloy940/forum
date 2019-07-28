<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Thread;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },

        'channel_id' => function () {
            return create('App\Channel')->id;
        },

        'title' => $faker->sentence,

        'body' => $faker->paragraph
    ];
});
