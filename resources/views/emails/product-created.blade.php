<h1>New product created</h1>
<p>A new product was created in the administration.</p>
<p>
    <strong>
        ID:
    </strong>
    {{ $product->id }}
    <br>
    <strong>Name:</strong>
    {{ $product->name }}
    <br>
    <strong>Hash:</strong>
    {{ $product->hash }}
    <br>
    <strong>Categories:</strong>
    {{ $product->categories->pluck('name')->join(', ') }}
</p>
