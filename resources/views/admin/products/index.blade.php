@extends('admin.layout')

@section('content')

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Products</h5>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
            + Add Product
        </a>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <table id="productsTable" class="table table-bordered table-striped w-100">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th width="150">Action</th>
                </tr>
            </thead>
        </table>

    </div>
</div>

<script>
$(function () {
    $('#productsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.products.index') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'sku', name: 'sku' },
            { data: 'price', name: 'price' },
            { data: 'stock', name: 'stock' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});
</script>

@endsection
