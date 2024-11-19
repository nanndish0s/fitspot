<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        // Fetch all products or apply filters for featured products
        $products = Product::all(); // Or use a filter like `Product::where('is_featured', 1)->get();`

        // Pass the products to the view
        return view('home', compact('products'));
    }
}
