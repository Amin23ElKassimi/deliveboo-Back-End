<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;
use App\Models\Order;


class FoodItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'restaurant_id',
        'description',
        'ingredients',
        'price',
        'image_url',
        'available',
    ];


    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
