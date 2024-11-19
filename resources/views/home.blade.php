<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page - FitSpot</title>
    <!-- Add Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Header -->
    <header class="bg-green-500 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold">FitSpot</h1>
            <nav class="flex space-x-4">
                <a href="/" class="text-white px-4 py-2 hover:bg-green-600 rounded">Home</a>
                <a href="/products" class="text-white px-4 py-2 hover:bg-green-600 rounded">Products</a>
                <!-- Cart Button -->
                <a href="/cart" class="text-white px-4 py-2 hover:bg-green-600 rounded">Cart</a> <!-- Add Cart Link here -->

                @auth
        @if(auth()->user()->role === 'seller')
            <!-- Show Seller Dashboard Button if User is a Seller -->
            <a href="/seller/dashboard" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Go to Seller Dashboard</a>
        @endif

        <!-- Show Logout Button -->
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="text-white px-4 py-2 bg-red-500 rounded hover:bg-red-600">
                Logout
            </button>
        </form>
    @else
        <!-- Show Login and Register Buttons if User is Not Logged In -->
        <a href="/login" class="text-white px-4 py-2 hover:bg-green-600 rounded">Login</a>
        <a href="/register" class="bg-white text-green-600 px-4 py-2 rounded hover:bg-gray-100">Register</a>
    @endauth
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-gray-800 text-white text-center py-20">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold">Welcome to FitSpot</h2>
            <p class="mt-4 text-xl">Your one-stop fitness app for gyms, products, and trainers.</p>
            <div class="mt-8">
                <a href="/products" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700">Shop Supplements</a>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="container mx-auto py-20 px-4">
        <h2 class="text-3xl font-bold text-center mb-8">Featured Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <!-- Loop through products -->
            @foreach ($products as $product)
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <!-- Display Product Image -->
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg">
                    
                    <!-- Display Product Name -->
                    <h3 class="text-xl font-semibold mt-4">{{ $product->name }}</h3>
                    
                    <!-- Display Product Description -->
                    <p class="text-gray-600 mt-2">{{ $product->description }}</p>
                    
                    <!-- Display Product Price -->
                    <p class="mt-4 text-lg font-bold">LKR {{ number_format($product->price, 2) }}</p>

                    <!-- View More Button -->
                    <a href="/products/{{ $product->id }}" class="bg-green-600 text-white py-2 px-4 rounded mt-4 block text-center hover:bg-green-700">View More</a>

                    <!-- Add to Cart Button -->
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700">Add to Cart</button>
                    </form>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 text-center">
        <p>&copy; 2024 FitSpot. All rights reserved.</p>
    </footer>

</body>
</html>
