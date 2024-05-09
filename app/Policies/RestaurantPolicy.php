<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Restaurant;

class RestaurantPolicy
{
    public function edit(User $user, Restaurant $restaurant)
    {
        return $user->id === $restaurant->user_id;
    }

    public function update(User $user, Restaurant $restaurant)
    {
        return $user->id === $restaurant->user_id;
    }

    // Altri metodi per la gestione dei ristoranti...

    public function delete(User $user, Restaurant $restaurant)
    {
        return $user->id === $restaurant->user_id;
    }
}
