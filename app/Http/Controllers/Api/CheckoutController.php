<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cart = auth()->user()->cart->load('items.product');

        if ($cart->items->isEmpty()) {
            return response()->json([
                'message' => 'Cart is empty'
            ], 400);
        }

        DB::beginTransaction();

        try {

            // Checking stock for all items
            foreach ($cart->items as $item) {
                if ($item->product->stock < $item->qty) {
                    DB::rollBack();

                    return response()->json([
                        'message' => 'Insufficient stock for ' . $item->product->name,
                        'available_stock' => $item->product->stock
                    ], 422);
                }
            }

            // Deducting stock only if all items have sufficient stock
            foreach ($cart->items as $item) {
                $item->product->decrement('stock', $item->qty);
            }

            // Clearing cart items
            $cart->items()->delete();

            DB::commit();

            return response()->json([
                'message' => 'Checkout successful. Stock updated.',
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Checkout failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
