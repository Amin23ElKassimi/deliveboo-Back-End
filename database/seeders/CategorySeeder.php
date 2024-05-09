<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Pizza',
                'image_url' => 'https://t3.ftcdn.net/jpg/00/27/57/96/360_F_27579652_tM7V4fZBBw8RLmZo0Bi8WhtO2EosTRFD.jpg',
            ],
            [
                'name' => 'Sushi',
                'image_url' => 'https://img.freepik.com/free-photo/maki-roll-with-cucumber-served-with-sauce-sesame-seeds_141793-790.jpg?w=360&t=st=1709658663~exp=1709659263~hmac=63a1444dafc4e7e7983dcf42eba0696ef14d5c72bfac54cc7acd4718a612e1e8',
            ],
            [
                'name' => 'Indiano',
                'image_url' => 'https://myindia.it/wp-content/uploads/2023/02/e1dad5315972c8a9db86fb01d69c7ecb.jpg',
            ],
            [
                'name' => 'Vegano',
                'image_url' => 'https://img.freepik.com/free-photo/fresh-vegetarian-pasta-meal-rustic-wooden-table-generated-by-ai_24640-81874.jpg',
            ],
            [
                'name' => 'Panini',
                'image_url' => 'https://media.istockphoto.com/id/930271208/it/foto/mozzarella-di-basilico-alla-griglia-sana-caprese-panini.jpg?s=612x612&w=0&k=20&c=qej6RYZeD0v1TlSMjA1s4qgTWZQ9OYMDBYsohHI0Mx8=',
            ],
        ];

        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->name = $category['name'];
            $newCategory->image_url = $category['image_url'];
            $newCategory->save();
        }
    }
}
