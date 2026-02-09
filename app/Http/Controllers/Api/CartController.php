<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CartItemRequest;
use App\Models\Product;
use App\Models\CartItem;

class CartController extends Controller
{
    public function add(CartItemRequest $request)
    {
        $cart = auth()->user()->cart;
        $product = Product::findOrFail($request->product_id);

        if ($product->stock <= 0) {
            return response()->json([
                'message' => 'Product is out of stock'
            ], 422);
        }

        $item = CartItem::where('cart_id', $cart->id)
                        ->where('product_id', $product->id)
                        ->first();

        if ($item) {
            $item->increment('qty', $request->qty);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'qty' => $request->qty,
                'price_at_time' => $product->price
            ]);
        }

        return response()->json(['message'=>'Added to cart'], 200);
    }

    public function view()
    {
        $cart = auth()->user()->cart->load('items.product');

        $total = $cart->items->sum(fn($i)=>$i->qty * $i->price_at_time);

        return response()->json([
            'items' => $cart->items,
            'total' => $total
        ]);
    }

    public function update(Request $request, $product_id)
    {
        $request->validate(['qty'=>'required|integer|min:1']);

        $item = CartItem::whereHas('cart', fn($q)=>$q->where('user_id', auth()->id()))
                        ->where('product_id', $product_id)
                        ->firstOrFail();

        $item->update(['qty'=>$request->qty]);

        return response()->json(['message'=>'Cart Updated']);
    }

    public function delete($product_id)
    {
        CartItem::whereHas('cart', fn($q)=>$q->where('user_id', auth()->id()))
                ->where('product_id', $product_id)
                ->delete();

        return response()->json(['message'=>'Product Removed']);
    }
}
