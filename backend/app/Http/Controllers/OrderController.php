<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Jobs\ProcessOrder;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrder;
use App\Notifications\OrderCreated;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new OrderCollection(Order::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrder $request)
    {
        $user = $request->user();
        $product = Product::find($request->product_id);

        // ProcessOrder::dispatch($user, $request->product_id, $request->quantity);
        $data = [
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'order_number' => Order::generateOrderNumber(),
            'amount' => $product->price * $request->quantity
        ];

        $order = $request->user()->orders()->create($data);

        $user->notify(new OrderCreated($order));

        $data = [
            'success' => true,
            'message' => trans('response.product_added'),
            'data' => [
                'user_id' => $user->id,
                'product_id' => $product->id,
                'amount' => ($request->quantity * $product->price),
                'quantity' => $request->quantity
            ]
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
