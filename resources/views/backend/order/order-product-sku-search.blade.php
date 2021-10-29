<ul>
	@foreach($products as $product)
	{{ $product }}
	<li>{{ $product->name }}</li>
	@endforeach
</ul>