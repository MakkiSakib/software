<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<h1>All Products</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

@foreach ($products as $product)
    <div class="product-card" id="product-{{ $product->Product_id }}">

        <img src="{{ asset('images/' . $product->Product_pic) }}" width="120">

        <h3>{{ $product->Product_name }}</h3>

        <p>Category: {{ $product->Category_name }}</p>
        <p>Brand: {{ $product->Brand_name }}</p>
        <p>Price: {{ $product->Price }} TK</p>

        <p>Available Quantity: {{ $product->Avaliable_quantity }}</p>

        <form action="{{ route('cart.add') }}#product-{{ $product->Product_id }}" method="POST">
            @csrf

            <label>Select Size:</label>
            <select name="size">
                <option>S</option>
                <option selected>M</option>
                <option>L</option>
                <option>XL</option>
            </select>

            <br><br>

            <label>Quantity:</label>
            <select name="quantity">
                @for($i = 1; $i <= $product->Avaliable_quantity; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>

            <input type="hidden" name="product_id" value="{{ $product->Product_id }}">

            <button type="submit">Add to Cart</button>
        </form>

    </div>
@endforeach
<a href="{{ route('cart.view') }}">Go to Cart</a>
</body>
</html>
