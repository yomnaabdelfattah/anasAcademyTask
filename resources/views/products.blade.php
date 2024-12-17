<h1>Products</h1>
<ul id="product-list">
    @foreach ($products as $product)
        <li>{{ $product->name }} - ${{ $product->price }}</li>
    @endforeach
</ul>

<form id="add-product-form">
    <input type="text" name="name" placeholder="Product Name" required>
    <input type="number" name="price" placeholder="Price" required>
    <input type="number" name="quantity" placeholder="Quantity" required>
    <button type="submit">Add Product</button>
</form>

<script>
    $('#add-product-form').submit(function (e) {
    e.preventDefault();

    $.ajax({
        url: '/api/products',
        method: 'POST',
        data: $(this).serialize(),
        success: function (response) {
            $('#product-list').append('<li>' + response.name + ' - $' + response.price + '</li>');
        },
        error: function () {
            alert('Failed to add product');
        }
    });
});

</script>