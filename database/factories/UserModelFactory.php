<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserModel;
use Faker\Generator as Faker;

// データベースに登録するデータを記入、今回はファクトリーとFakerクラスを使ってダミデータを登録する方法。
$factory->define(UserModel::class, function (Faker $faker) {
    return [
        'user_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make($faker->password()),
    ];
});
