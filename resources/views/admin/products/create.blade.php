@extends('admin.layout')

@section('content')

<div class="container mt-4">
    <h3 class="mb-4">Add Product</h3>

    <form method="POST" action="{{ route('admin.products.store') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   id="name"
                   name="name"
                   placeholder="Enter product name"
                   value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- SKU -->
        <div class="mb-3">
            <label for="sku" class="form-label">SKU</label>
            <input type="text"
                   class="form-control @error('sku') is-invalid @enderror"
                   id="sku"
                   name="sku"
                   placeholder="Enter SKU"
                   value="{{ old('sku') }}">
            @error('sku')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number"
                   class="form-control @error('price') is-invalid @enderror"
                   id="price"
                   name="price"
                   placeholder="Enter price"
                   value="{{ old('price') }}">
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Stock -->
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number"
                   class="form-control @error('stock') is-invalid @enderror"
                   id="stock"
                   name="stock"
                   placeholder="Enter stock quantity"
                   value="{{ old('stock') }}">
            @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
        </div>

    </form>
</div>

@endsection
