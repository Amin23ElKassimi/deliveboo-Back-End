<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\FoodItem;
use Faker\Generator as Faker;


class foodItemOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $foodItems = FoodItem::all();
        $orderIds = Order::all()->pluck('id');

        foreach ($foodItems as $foodItem) {
            $foodItem->orders()->sync($faker->randomElements($orderIds, rand(1, 1), false));
        }
    }
}
