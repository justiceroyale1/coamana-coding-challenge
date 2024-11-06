<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\OrderCreated;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class ProcessOrder implements ShouldQueue
{
    use Queueable;

    protected $user;
    protected $productId;
    protected $quantity;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, int $productId, int $quantity)
    {
        // dd('dispatched!');
        $this->user = $user;
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $product = Product::find($this->productId);
        $data = [
            'product_id' => $product->id,
            'quantity' => $this->quantity,
            'order_number' => Order::generateOrderNumber(),
            'amount' => $product->price * $this->quantity
        ];

        $order = $this->user->orders()->create($data);

        Notification::send($this->user, new OrderCreated($order));
    }
}
