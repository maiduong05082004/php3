<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('id', '<>', 0)->where('status', '<>', 3)->orderBy('id', 'desc')->get();
        return view('admin.categories.index', compact('categories'));
    }
    
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Categories created successfully.');
    }

    public function show($id)
    {
        return view('admin.categories.show', compact('Categories'));
    }

    public function edit($id)
    {
        $Categories = Category::query()->find($id);
        return view('admin.categories.edit', compact('Categories'));
    }

    public function update(Request $request, int $id)
    {
        $Categories = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $data = $request->all();
        $Categories->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Categories updated successfully.');
    }
    public function softDestroy($id)
    {
        $Categories = Category::findOrFail($id);
        $Categories->update(['status' => 3]);
        return redirect()->route('admin.categories.index')->with('success', 'Categories moved to trash successfully.');
    }
    public function destroy($id)
    {
        $Categories = Category::findOrFail($id);
        $Categories->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Categories deleted successfully.');
    }
    public function trash(){
        $categories = Category::where('status',3)->get();
        return view('admin.categories.trash', compact('categories'));
    }
    public function restore($id){
        $Categories = Category::findOrFail($id);
        $Categories->update(['status' => 1]);
        return redirect()->route('admin.categories.trash')->with('success', 'Categories restored successfully.');
    }
    public function forceDelete($id)
    {
        $category = Category::findOrFail($id);
        Product::where('category_id', $category->id)
        ->update(['category_id' => 0]);
        $category->delete();

        return redirect()->route('admin.categories.trash')->with('success', 'Categories permanently deleted successfully.');
    }
}
