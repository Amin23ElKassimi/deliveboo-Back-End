<?php

namespace App\Policies;

use App\Models\User;
use App\Models\FoodItem;
use App\Models\Restaurant;

class FoodItemPolicy
{
    public function edit(User $user, FoodItem $foodItem)
    {
        return $user->id === $foodItem->restaurant_id;
    }
    public function update(User $user, FoodItem $foodItem)
    {
        return $user->id === $foodItem->user_id;
    }

    // Altri metodi per la gestione dei ristoranti...

    public function delete(User $user, FoodItem $foodItem)
    {
        return $user->id === $foodItem->user_id;
    }
}
