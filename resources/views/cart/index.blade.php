<!-- resources/views/cart/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - FitSpot</title>
    <!-- Add Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Navbar -->
    <header class="bg-green-500 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold">FitSpot</h1>
            <nav>
                <a href="/" class="text-white px-4 py-2 hover:bg-green-600 rounded">Home</a>
                <a href="/products" class="text-white px-4 py-2 hover:bg-green-600 rounded">Products</a>
                <a href="/cart" class="text-white px-4 py-2 hover:bg-green-600 rounded">Cart</a>
            </nav>
        </div>
    </header>

    <!-- Page Title Section -->
    <section class="bg-gray-800 text-white text-center py-20">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold">Your Shopping Cart</h2>
            <p class="mt-4 text-xl">Review your items before checkout.</p>
        </div>
    </section>

    <!-- Cart Items Section -->
    <section class="container mx-auto py-20 px-4">
        @if ($cartItems->isEmpty())
            <p class="text-center text-xl">Your cart is empty!</p>
        @else
            <div class="overflow-x-auto bg-white shadow-md rounded-lg p-6">
                <ul class="space-y-6">
                    @foreach ($cartItems as $cartItem)
                        <li class="flex justify-between items-center border-b py-4">
                            <div class="flex items-center">
                                @if ($cartItem->product->image)
                                    <img src="{{ asset('storage/'.$cartItem->product->image) }}" alt="{{ $cartItem->product->name }}" class="w-16 h-16 object-cover rounded-md mr-4">
                                @else
                                    <img src="https://via.placeholder.com/150" alt="{{ $cartItem->product->name }}" class="w-16 h-16 object-cover rounded-md mr-4">
                                @endif
                                <div>
                                    <p class="text-xl font-semibold">{{ $cartItem->product->name }} ({{ $cartItem->quantity }})</p>
                                    <p class="text-gray-600">Price: LKR {{ number_format($cartItem->product->price, 2) }}</p>
                                </div>
                            </div>

                            <!-- Quantity Input and Update Button -->
                            <div class="flex items-center space-x-4">
                                <form action="{{ route('cart.update', $cartItem->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1" class="w-16 px-2 py-1 border border-gray-300 rounded-md">
                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Update</button>
                                </form>
                            </div>

                            <!-- Remove Button -->
                            <div class="flex items-center space-x-4">
                                <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Remove</button>
                                </form>
                            </div>

                            <div class="text-lg font-semibold">
                                Total: LKR {{ number_format($cartItem->quantity * $cartItem->product->price, 2) }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Total Price Section -->
        @if (!$cartItems->isEmpty())
            <div class="mt-8 flex justify-between items-center bg-gray-800 text-white p-4 rounded-lg">
                <p class="text-2xl font-semibold">Total Price:</p>
                <p class="text-2xl font-bold">LKR {{ number_format($total, 2) }}</p>
            </div>
        @endif
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 text-center">
        <p>&copy; 2024 FitSpot. All rights reserved.</p>
    </footer>

</body>
</html>
