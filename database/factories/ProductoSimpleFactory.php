<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use  Restaurante\Producto\Infrastructure\Eloquent\ProductoSimpleModel;
use Faker\Generator as Faker;

$factory->define(ProductoSimpleModel::class, function (Faker $faker) {
    return [
        'sku' => $faker->unique()->uuid,
        'nombre' => $faker->name,
        'costo' =>$faker->randomFloat(2,1000,20000),
        'precio' => $faker->randomFloat(2,1000,20000)
    ];
});
