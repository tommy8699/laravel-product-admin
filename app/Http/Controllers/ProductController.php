<?php

namespace App\Http\Controllers;

use App\Mail\ProductCreatedMail;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('products.index', ['products' => Product::with('categories')->latest()->paginate(10)]);
    }

    public function create(): View
    {
        return view('products.create', ['categories' => Category::orderBy('name')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $mailTo = config('mail.admin_address');
        $data = $request->validate(['name' => ['required', 'string', 'max:255'], 'description' => ['nullable', 'string'], 'categories' => ['required', 'array', 'min:1'], 'categories.*' => ['integer', 'exists:categories,id']]);

        do {
            $hash = Str::random(16);
        } while (Product::where('hash', $hash)->exists());

        $product = Product::create(['name' => $data['name'], 'description' => $data['description'] ?? null, 'hash' => $hash]);
        $product->categories()->sync($data['categories']);

        Mail::to($mailTo)->later(now()->addMinutes(15), new ProductCreatedMail($product->load('categories')));

        return redirect()->route('products.index')->with('success', __('messages.created'));
    }

    public function edit(Product $product): View
    {
        $product->load('categories');
        return view('products.edit', ['product' => $product, 'categories' => Category::orderBy('name')->get()]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:255'], 'description' => ['nullable', 'string'], 'categories' => ['required', 'array', 'min:1'], 'categories.*' => ['integer', 'exists:categories,id']]);

        $product->update(['name' => $data['name'], 'description' => $data['description'] ?? null]);
        $product->categories()->sync($data['categories']);

        return redirect()->route('products.index')->with('success', __('messages.updated'));
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', __('messages.deleted'));
    }
}
