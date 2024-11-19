<!-- resources/views/products.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - FitSpot</title>
    <!-- Add Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Header -->
    <header class="bg-green-500 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold">FitSpot</h1>
            <nav>
                <a href="/" class="text-white px-4 py-2 hover:bg-green-600 rounded">Home</a>
                <a href="/products" class="text-white px-4 py-2 hover:bg-green-600 rounded">Products</a>
                <!-- Cart Button -->
                <a href="/cart" class="text-white px-4 py-2 hover:bg-green-600 rounded">Cart</a>
            </nav>
        </div>
    </header>

    <!-- Page Title Section -->
    <section class="bg-gray-800 text-white text-center py-20">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold">Our Products</h2>
            <p class="mt-4 text-xl">Shop the best supplements for your fitness journey</p>
        </div>
    </section>

    <!-- Product Listings Section -->
    <section class="container mx-auto py-20 px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($products as $product)
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    @if ($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg">
                    @else
                        <img src="https://via.placeholder.com/150" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg">
                    @endif
                    <h3 class="text-xl font-semibold mt-4">{{ $product->name }}</h3>
                    <p class="text-gray-600 mt-2">{{ $product->description }}</p>
                    <p class="mt-4 text-lg font-bold">LKR {{ number_format($product->price, 2) }}</p>
                    <p class="text-gray-600 mt-2">Available Quantity: {{ $product->quantity }}</p>
                    <div class="mt-4 flex justify-between items-center">
                        <a href="{{ route('products.show', $product->id) }}" class="text-green-600 hover:underline">View Product</a>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700">Add to Cart</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            <div class="pagination flex justify-center">
                {{ $products->links() }}
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 text-center">
        <p>&copy; 2024 FitSpot. All rights reserved.</p>
    </footer>

</body>
</html>
