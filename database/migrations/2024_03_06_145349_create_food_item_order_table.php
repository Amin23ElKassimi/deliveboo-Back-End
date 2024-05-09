<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('food_item_order', function (Blueprint $table) {
            $table->unsignedBigInteger('food_item_id');
            $table->foreign('food_item_id')->references('id')->on('food_items')->cascadeOnDelete();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();

            $table->primary(['food_item_id', 'order_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_item_order');
    }
};
