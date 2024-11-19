<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <!-- Product Image Section -->
                            <div class="col-md-5 text-center mb-3">
                                @if ($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded">
                                @else
                                    <img src="https://via.placeholder.com/300" alt="Placeholder Image" class="img-fluid rounded">
                                @endif
                            </div>

                            <!-- Product Details Section -->
                            <div class="col-md-7">
                                <h2 class="card-title text-primary">{{ $product->name }}</h2>
                                <p class="card-text">{{ $product->description }}</p>
                                <hr>
                                <p class="h5 text-success">Price: LKR{{ $product->price }}</p>
                                <p class="text-secondary">Available Quantity: {{ $product->quantity }}</p>

                                <!-- Functional Buttons -->
                                <div class="mt-4">
                                    <!-- Add to Cart Button -->
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary me-2">Add to Cart</button>
                                    </form>
                                    
                                    <!-- Back to Products Button -->
                                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Back to Products</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
