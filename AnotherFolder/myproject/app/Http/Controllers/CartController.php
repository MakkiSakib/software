<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController 
{
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        if ($request->quantity > $product->Avaliable_quantity) {
            return back()->with('error', 'Not enough stock!');
        }

        $existing = Cart::where('Product_id', $product->Product_id)
                        ->where('Size', $request->size)
                        ->first();

        if ($existing) {

            $newQty = $existing->Quantity + $request->quantity;

            if ($newQty > $product->Avaliable_quantity) {
                return back()->with('error', 'Not enough stock!');
            }

            $existing->update([
                'Quantity' => $newQty,
                'Total_price' => $newQty * $product->Price,
            ]);

        } else {
            Cart::create([
                'User_id' => null,
                'Product_id' => $product->Product_id,
                'Size' => $request->size,
                'Quantity' => $request->quantity,
                'Price' => $product->Price,
                'Total_price' => $product->Price * $request->quantity,
            ]);
        }

        return back()->with('success', 'Added to cart');
    }

    public function viewCart()
    {
        $cartItems = Cart::with('product')->get();
        $grandTotal = $cartItems->sum('Total_price');

        return view('cart', compact('cartItems', 'grandTotal'));
    }

    public function increaseQuantity($id)
    {
        $cart = Cart::findOrFail($id);
        $product = $cart->product;

        if ($cart->Quantity + 1 > $product->Avaliable_quantity) {
            return back()->with('error', 'Not enough stock!');
        }

        $cart->Quantity++;
        $cart->Total_price = $cart->Quantity * $product->Price;
        $cart->save();

        return back();
    }

    public function decreaseQuantity($id)
    {
        $cart = Cart::findOrFail($id);

        if ($cart->Quantity <= 1) {
            $cart->delete();
            return back();
        }

        $cart->Quantity--;
        $cart->Total_price = $cart->Quantity * $cart->Price;
        $cart->save();

        return back();
    }

    public function removeItem($id)
    {
        Cart::destroy($id);
        return back();
    }
}
