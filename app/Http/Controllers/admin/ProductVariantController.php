<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Color;
use App\Models\Size;
use App\Models\ImageLibrary;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    public function index($productId)
    {
        $product = Product::findOrFail($productId);
        $variants = ProductVariant::where('product_id', $productId)->with(['color', 'size', 'images'])->get();
        return view('admin.product_variants.index', compact('product', 'variants'));
    }

    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        $colors = Color::all();
        $sizes = Size::all();
        $images = ImageLibrary::all();
        return view('admin.product_variants.create', compact('product', 'colors', 'sizes', 'images'));
    }

    public function store(Request $request, $productId)
    {
        $request->validate([
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,web,webp|max:2048',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $variant = ProductVariant::create([
            'product_id' => $productId,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $imageLibrary = ImageLibrary::create(['url' => $path]);
                $variant->images()->attach($imageLibrary->id);
            }
        }

        return redirect()->route('admin.products.product_variants.index', $productId)->with('success', 'Product variant created successfully.');
    }

    public function edit($productId, $id)
    {
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($id);
        $colors = Color::all();
        $sizes = Size::all();
        $images = ImageLibrary::all();
        return view('admin.product_variants.edit', compact('product', 'variant', 'colors', 'sizes', 'images'));
    }

    public function update(Request $request, $productId, $id)
    {
        $variant = ProductVariant::findOrFail($id);

        $request->validate([
            'colors_id' => 'required|exists:colors,id',
            'sizes_id' => 'required|exists:sizes,id',
            'image_libraries_id' => 'nullable|exists:image_libraries,id',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $variant->update($request->all());

        return redirect()->route('admin.products.product_variants.index', $productId)->with('success', 'Product variant updated successfully.');
    }

    public function destroy($productId, $id)
    {
        $variant = ProductVariant::findOrFail($id);
        $variant->delete();

        return redirect()->route('admin.products.product_variants.index', $productId)->with('success', 'Product variant deleted successfully.');
    }
}

