<?php namespace Database\Factories;

use Faker\Generator as Faker;

$factory->define(\App\Models\Roles::class, function (Faker $faker) {
    return [
      'name' => 'admin',
      'admin' => true,
      'display_name' => 'Роль администратора',
      'created_at' => date("Y-m-d H:i:s"),
      'updated_at' => date("Y-m-d H:i:s")
    ];
});
