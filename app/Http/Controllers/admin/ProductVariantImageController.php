<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use App\Models\ImageLibrary;
use Illuminate\Http\Request;

class ProductVariantImageController extends Controller
{
    public function index($productId, $variantId)
    {
        $variant = ProductVariant::with('product')->findOrFail($variantId);
        $images = $variant->images;

        return view('admin.product_variant_images.index', compact('variant', 'images'));
    }

    public function create($productId, $variantId)
    {
        $variant = ProductVariant::findOrFail($variantId);
        return view('admin.product_variant_images.create', compact('variant'));
    }

    public function store(Request $request, $productId, $variantId)
    {
        $request->validate([
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,web,webp|max:2048',
        ]);

        $variant = ProductVariant::findOrFail($variantId);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $imageLibrary = ImageLibrary::create(['url' => $path]);
                $variant->images()->attach($imageLibrary->id);
            }
        }

        return redirect()->route('admin.products.product_variants.product_variant_images.index', ['productId' => $productId, 'variantId' => $variantId])->with('success', 'Images uploaded successfully.');
    }

    public function destroy($productId, $variantId, $imageId)
    {
        $variant = ProductVariant::findOrFail($variantId);
        $image = ImageLibrary::findOrFail($imageId);
        $variant->images()->detach($imageId);
        $image->delete();

        return redirect()->route('admin.products.product_variants.product_variant_images.index', ['productId' => $productId, 'variantId' => $variantId])->with('success', 'Image deleted successfully.');
    }
}
