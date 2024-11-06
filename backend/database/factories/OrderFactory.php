<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_number' => Order::generateOrderNumber(),
            'user_id' => User::factory(),
            'product_id' => Product::factory(),
            'amount' => function (array $attributes): float|int {
                return $attributes['quantity'] * Product::find($attributes['product_id'])->price;
            },
            'quantity' => fake()->numberBetween(1, 200)
        ];
    }
}
