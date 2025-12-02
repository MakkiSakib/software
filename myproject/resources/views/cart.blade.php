<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
</head>
<body>

<h1>Your Cart</h1>

@if(session('success')) <p style="color:green">{{ session('success') }}</p> @endif
@if(session('error')) <p style="color:red">{{ session('error') }}</p> @endif

@foreach ($cartItems as $item)
    <div class="cart-item">


        <img src="{{ asset('images/' . $item->product->Product_pic) }}" width="100">

        <h3>{{ $item->product->Product_name }}</h3>

        <p>Size: {{ $item->Size }}</p>
        <p>Price (Unit): ${{ $item->product->Price }}</p>

        <p>
            Quantity: 
            <form action="{{ route('cart.decrease', $item->Cart_id) }}" method="POST" style="display:inline">
                @csrf
                <button>-</button>
            </form>

            {{ $item->Quantity }}

            <form action="{{ route('cart.increase', $item->Cart_id) }}" method="POST" style="display:inline">
                @csrf
                <button>+</button>
            </form>
        </p>

        <p>Total Price: ${{ $item->Total_price }}</p>

        <form action="{{ route('cart.remove', $item->Cart_id) }}" method="POST">
            @csrf
            <button style="color:red;">Remove Item</button>
        </form>

    </div>
@endforeach

<h2>Grand Total: ${{ $grandTotal }}</h2>

<a href="/">Back to Products</a>

</body>
</html>
