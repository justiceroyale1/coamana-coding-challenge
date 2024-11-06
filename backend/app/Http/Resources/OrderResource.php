<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'username' => $this->whenLoaded('user', $this->user->fullname),
            'product' => $this->whenLoaded('product', $this->product->name),
            'amount' => number_format($this->quantity * $this->product->price),
            'quantity' => number_format($this->quantity),
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}