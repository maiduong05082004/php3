<?php

namespace App\Http\Controllers\admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|image|mimes:jpeg,png,jpg,gif,svg,web,webp,avif|max:2048',
            'is_active' => 'boolean',
        ]);

        $imagePath = $request->file('url')->store('banners', 'public');

        Banner::create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $imagePath,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully.');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,web,webp,avif|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->only(['title', 'description', 'is_active']);
        if ($request->hasFile('url')) {
            Storage::disk('public')->delete($banner->url);
            $data['url'] = $request->file('url')->store('banners', 'public');
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        Storage::disk('public')->delete($banner->url);
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully.');
    }
}
