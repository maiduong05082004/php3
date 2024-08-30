<h1>{{ $product->first()->product_name }}</h1>
<img src="{{ asset('storage/' . $product->first()->product_image) }}" alt="{{ $product->first()->product_name }}">
<p>{{ $product->first()->product_description }}</p>

<h2>Biến thể:</h2>
@foreach($product as $variant)
    <div>
        <h3>Màu: {{ $variant->color_name }} - Kích thước: {{ $variant->size_name }}</h3>
        <p>Giá: {{ $variant->variant_price_sale ?? $variant->variant_price }}</p>
        @if($variant->variant_image)
            <img src="{{ asset('storage/' . $variant->variant_image) }}" alt="Variant Image">
        @endif
    </div>
@endforeach
