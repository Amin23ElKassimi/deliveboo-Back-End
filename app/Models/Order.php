<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FoodItem;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_address',
        'customer',
        'status',
        'total',
        'user_mail',
        'user_phone_number',
    ];

    public function foodItems()
    {
        return $this->belongsToMany(FoodItem::class);
    }
}
