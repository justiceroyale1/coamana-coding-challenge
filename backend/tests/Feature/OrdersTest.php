<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Jobs\ProcessOrder;
use App\Notifications\OrderCreated;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdersTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_order(): void
    {
        Notification::fake();

        $user = User::factory()
            ->create();
        $product = Product::factory()
            ->create();
        $data = [
            'product_id' => $product->id,
            'quantity' => 10
        ];

        $response = $this->actingAs($user)
            ->post(route('orders.store'), $data);

        $response->assertOk()
            ->assertJson(
                fn(AssertableJson $json) =>
                $json->where('success', true)
                    ->where('message', trans('response.product_added'))
                    ->has(
                        'data',
                    )
                    ->etc()
            );

        $this->assertDatabaseHas('orders', [
            ...$data,
            'user_id' => $user->id
        ]);

        Notification::assertSentTo(
            [$user],
            OrderCreated::class
        );
    }

    public function test_list_orders(): void
    {
        $user = User::factory()
            ->create();
        $product = Product::factory()
            ->count(10)
            ->create();

        $response = $this->actingAs($user)
            ->get(route('orders.index'));

        $response->assertOk()
            ->assertJson(
                fn(AssertableJson $json) =>
                $json->hasAll([
                    'data',
                    'links'
                ])->etc()
            );
    }
}
