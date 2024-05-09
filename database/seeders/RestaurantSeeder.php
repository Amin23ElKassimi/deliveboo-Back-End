<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $restaurants = [
            [
                'name' => 'La regina margherita',
                'user_id' => 1,
                'vat' => 123456789,
                'address' => 'via dei Pollicini, Santa Maria Capua Vetere (CE)',
                'phone_number' => 348945687,
                'email' => 'ma_che_dici@gmail.com',
                'image_url' => 'https://img.ilgcdn.com/sites/default/files/styles/xl/public/foto/2019/12/29/1577604943-marghe.jpg?_=1577604943',
            ],
            [
                'name' => 'Il Mirò',
                'user_id' => 2,
                'vat' => 987654321,
                'address' => 'Via Napoli, 123, Napoli (NA)',
                'phone_number' => 348123456,
                'email' => 'ilpizzaiuolo@gmail.com',
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFr7jukhT0wE92VugncMhRH3qiAR1DdHXmYw&usqp=CAU',
            ],
            [
                'name' => 'Ristorante da Gino',
                'user_id' => 3,
                'vat' => 654321987,
                'address' => 'Piazza Garibaldi, 1, Roma (RM)',
                'phone_number' => 333987654,
                'email' => 'ristorantedagino@gmail.com',
                'image_url' => 'https://www.paninotecadagino.it/wp-content/uploads/2021/04/cd8f7ca2-d291-4339-98d5-070b55732668.jpg',
            ],
            [
                'name' => 'Trattoria Nonna Maria',
                'user_id' => 4,
                'vat' => 147258369,
                'address' => 'Via Toscana, 5, Firenze (FI)',
                'phone_number' => 333456789,
                'email' => 'nonnamaria@yahoo.it',
                'image_url' => 'https://static.wixstatic.com/media/c0df87_4a30ab5def3c4db7a9316aa1899f3c79~mv2.jpg/v1/fill/w_560,h_400,al_c,q_80,usm_0.66_1.00_0.01,enc_auto/c0df87_4a30ab5def3c4db7a9316aa1899f3c79~mv2.jpg',
            ],
            [
                'name' => 'Osteria del Pescatore',
                'user_id' => 5,
                'vat' => 369852147,
                'address' => 'Lungomare, 10, Bari (BA)',
                'phone_number' => 333123456,
                'email' => 'osteriadelpescatore@hotmail.com',
                'image_url' => 'https://www.amioparere.com/images/locali/6b7d-fronte.jpg',
            ],
            [
                'name' => 'Pestana Cr7',
                'user_id' => 6,
                'vat' => 369852198,
                'address' => 'Lungomare, 10, Roccaraso (AQ)',
                'phone_number' => 333123456,
                'email' => 'cr7@gmail.com',
                'image_url' => 'https://logowik.com/content/uploads/images/pestana-cr7-lifestyle-hotels6271.logowik.com.webp',
            ],
        ];

        foreach ($restaurants as $restaurant) {
            $newRestaurants = new Restaurant();
            $newRestaurants->name = $restaurant['name'];
            $newRestaurants->user_id = $restaurant['user_id'];
            $newRestaurants->vat = $restaurant['vat'];
            $newRestaurants->address = $restaurant['address'];
            $newRestaurants->phone_number = $restaurant['phone_number'];
            $newRestaurants->email = $restaurant['email'];
            $newRestaurants->image_url = $restaurant['image_url'];
            $newRestaurants->save();
        }
    }
}
