<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class RestaurantCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $restaurants = Restaurant::all();
        $categoryIds = Category::all()->pluck('id');

        foreach ($restaurants as $restaurant) {
            $restaurant->categories()->sync($faker->randomElements( $categoryIds, rand(1,5), false ));
        }

    }

}
    