<?php

namespace App\Http\Controllers;
use App\Models\Product; // Add this import
use App\Models\Cart;     // Import the Cart model
use Illuminate\Support\Facades\Auth;  // <-- Import the Auth facade
use App\Models\CartItem;



use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    // Add a product to the cart
    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);

        // Check if the product is already in the user's cart
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            // If the product is already in the cart, update the quantity
            $cartItem->quantity += 1;  // You can also change this to increase by a custom value
            $cartItem->save();
        } else {
            // If the product is not in the cart, create a new cart item
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => 1,  // Set initial quantity to 1
            ]);
        }

        return redirect()->route('cart.index');  // Redirect to cart page after adding
    }

    // Show the user's cart
    public function index()
    {
          // Fetch the user's cart items with the associated product details
        $cartItems = auth()->user()->cart()->with('product')->get();

        // Calculate the total price of the items in the cart
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        // Return the view with cartItems and total price
        return view('cart.index', compact('cartItems', 'total'));
    }

    public function remove($id)
    {
        // Find the cart item using the Cart model
        $cartItem = Cart::findOrFail($id);
    
        // Delete the cart item
        $cartItem->delete();
    
        // Redirect back to the cart with a success message
        return redirect()->route('cart.index')->with('success', 'Item removed from the cart.');
    }
    

    public function update(Request $request, Cart $cart)
    {
         // Validate the new quantity
         $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Update the quantity of the product in the cart
        $cart->update([
            'quantity' => $request->quantity,
        ]);

        // Redirect back to the cart page with a success message
        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');  
    }
}
