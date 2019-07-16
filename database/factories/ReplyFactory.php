<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Reply;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'thread_id' => function () {
            return factory('App\Thread')->create()->id;
        },

        'user_id' => function () {
            return factory('App\User')->create()->id;
        },

        'body' => $faker->paragraph
    ];
});
