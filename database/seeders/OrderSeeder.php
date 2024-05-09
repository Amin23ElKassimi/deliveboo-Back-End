<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'user_address' => 'Via Sevastopoli 5, 40134, Catanzaro',
                'customer' => 'Peppino De Longhi',
                'status' => 1,
                'total' => 89.00,
                'user_mail' => 'PeppinoDL99@gmail.com',
                'user_phone_number' => 333333333,
            ],
            [
                'user_address' => 'Via Garibaldi 12, 20100, Milano',
                'customer' => 'Giulia Rossi',
                'status' => 2,
                'total' => 129.50,
                'user_mail' => 'giulia.rossi@example.com',
                'user_phone_number' => 3479876543,
            ],
            [
                'user_address' => 'Via Roma 20, 00100, Roma',
                'customer' => 'Marco Bianchi',
                'status' => 1,
                'total' => 45.80,
                'user_mail' => 'mbianchi@hotmail.com',
                'user_phone_number' => 3661234567,
            ],
            [
                'user_address' => 'Piazza del Duomo 1, 50123, Firenze',
                'customer' => 'Anna Maria Ferrara',
                'status' => 1,
                'total' => 75.20,
                'user_mail' => 'annamaria.ferrara@gmail.com',
                'user_phone_number' => 3487654321,
            ],
            [
                'user_address' => 'Corso Vittorio Emanuele 15, 10121, Torino',
                'customer' => 'Luigi Verdi',
                'status' => 2,
                'total' => 102.75,
                'user_mail' => 'luigi.verdi@libero.it',
                'user_phone_number' => 3349876543,
            ],
            [
                'user_address' => 'Viale dei Fiori 8, 20145, Milano',
                'customer' => 'Sara Neri',
                'status' => 1,
                'total' => 55.90,
                'user_mail' => 'sara.neri@example.com',
                'user_phone_number' => 3209876543,
            ],
            [
                'user_address' => 'Via San Martino 3, 34100, Trieste',
                'customer' => 'Enrico Bianchi',
                'status' => 1,
                'total' => 95.60,
                'user_mail' => 'e.bianchi@gmail.com',
                'user_phone_number' => 3401234567,
            ],
            [
                'user_address' => 'Via del Corso 10, 00186, Roma',
                'customer' => 'Maria Rossi',
                'status' => 2,
                'total' => 120.00,
                'user_mail' => 'maria.rossi@hotmail.com',
                'user_phone_number' => 3498765432,
            ],
            [
                'user_address' => 'Piazza San Marco 6, 30124, Venezia',
                'customer' => 'Giovanni Verdi',
                'status' => 1,
                'total' => 65.30,
                'user_mail' => 'g.verdi@example.com',
                'user_phone_number' => 3665432109,
            ],
            [
                'user_address' => 'Via Dante 15, 20121, Milano',
                'customer' => 'Roberta Bianchi',
                'status' => 1,
                'total' => 82.40,
                'user_mail' => 'roberta.bianchi@gmail.com',
                'user_phone_number' => 3398765432,
            ],
            [
                'user_address' => 'Corso Umberto I 20, 80100, Napoli',
                'customer' => 'Paolo Rossi',
                'status' => 2,
                'total' => 98.50,
                'user_mail' => 'paolo.rossi@yahoo.com',
                'user_phone_number' => 3887654321,
            ],
            [
                'user_address' => 'Piazza della Repubblica 3, 50123, Firenze',
                'customer' => 'Alessia Bianchi',
                'status' => 1,
                'total' => 70.10,
                'user_mail' => 'alessia.bianchi@example.com',
                'user_phone_number' => 3209876543,
            ],
            [
                'user_address' => 'Via Garibaldi 1, 10100, Torino',
                'customer' => 'Mario Verdi',
                'status' => 1,
                'total' => 110.80,
                'user_mail' => 'mario.verdi@gmail.com',
                'user_phone_number' => 3345678901,
            ],
            [
                'user_address' => 'Piazza Navona 5, 00186, Roma',
                'customer' => 'Elisa Rossi',
                'status' => 1,
                'total' => 135.60,
                'user_mail' => 'elisa.rossi@hotmail.com',
                'user_phone_number' => 3490123456,
            ],
            [
                'user_address' => 'Via della Libertà 30, 90100, Palermo',
                'customer' => 'Alessandro Bianchi',
                'status' => 1,
                'total' => 60.20,
                'user_mail' => 'alessandro.bianchi@example.com',
                'user_phone_number' => 3887654321,
            ],
        ];

        foreach ($orders as $order) {
            $newOrder = new Order();

            $newOrder->user_address = $order['user_address'];
            $newOrder->customer = $order['customer'];
            $newOrder->status = $order['status'];
            $newOrder->total = $order['total'];
            $newOrder->user_mail = $order['user_mail'];
            $newOrder->user_phone_number = $order['user_phone_number'];
            $newOrder->save();
        }
    }
}
