<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Product::query();

            return DataTables::of($query)
                ->addIndexColumn()
                ->filter(function ($q) use ($request) {
                    if ($request->search['value'] ?? false) {
                        $search = $request->search['value'];
                        $q->where(function ($query) use ($search) {
                            $query->where('name', 'like', "%{$search}%")
                                ->orWhere('sku', 'like', "%{$search}%");
                        });
                    }
                })
                ->addColumn('action', function ($product) {
                    $edit = '<a href="'.route("admin.products.edit", $product->id).'" class="btn btn-sm btn-primary">Edit</a>';
                    $delete = '<form action="'.route("admin.products.destroy", $product->id).'" method="POST" style="display:inline-block;">
                                '.csrf_field().'
                                '.method_field("DELETE").'
                                <button class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>
                            </form>';
                    return $edit.' '.$delete;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.products.index');
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(ProductRequest $request)
    {
        Product::create($request->validated());

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product added successfully');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }
}

