<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductManagementController extends Controller
{
    public function index(): View
    {
        return view('admin.products.index', ['products' => Product::latest()->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'coins' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'integer', 'min:1000'],
        ]);

        Product::create($data + ['is_active' => true]);

        return back()->with('status', 'Produk ditambahkan.');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'coins' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'integer', 'min:1000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $product->update($data);

        return back()->with('status', 'Produk diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return back()->with('status', 'Produk dihapus.');
    }
}
