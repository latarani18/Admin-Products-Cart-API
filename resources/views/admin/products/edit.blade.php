@extends('admin.layout')

@section('content')

<div class="container mt-4">
    <h3 class="mb-4">Edit Product</h3>

    <form method="POST" action="{{ route('admin.products.update', $product->id) }}">
        @csrf
        @method('PUT')

        <!-- NAME -->
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                   id="name" name="name" 
                   value="{{ old('name', $product->name) }}" 
                   placeholder="Enter product name">

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- SKU -->
        <div class="mb-3">
            <label for="sku" class="form-label">SKU</label>
            <input type="text" class="form-control @error('sku') is-invalid @enderror" 
                   id="sku" name="sku" 
                   value="{{ old('sku', $product->sku) }}" 
                   placeholder="Enter SKU">

            @error('sku')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- PRICE -->
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                   id="price" name="price" 
                   value="{{ old('price', $product->price) }}" 
                   placeholder="Enter price">

            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- STOCK -->
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                   id="stock" name="stock" 
                   value="{{ old('stock', $product->stock) }}" 
                   placeholder="Enter stock quantity">

            @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- BUTTONS -->
        <div class="mb-3">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
        </div>

    </form>
</div>

@endsection
