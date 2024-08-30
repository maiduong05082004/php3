<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('id', '<>', 0)->where('status', '<>', 3)->whereNull('parent_id')->orderBy('id', 'desc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create(Request $request)
    {
        $categories = Category::whereNull('parent_id')->get();
        $parent_id = $request->query('parent_id');
        return view('admin.categories.create', compact('categories', 'parent_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = Category::create($request->all());

        if ($category->parent_id) {
            return redirect()->route('admin.categories.subcategories', $category->parent_id)->with('success', 'Danh mục con đã được tạo thành công.');
        }

        return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được tạo thành công.');
    }

    public function show($id)
    {
        return view('admin.categories.show', compact('Categories'));
    }

    public function edit($id)
    {
        $Categories = Category::findOrFail($id);
        $SubCategories = Category::whereNull('parent_id')->where('id', '!=', $id)->get();
        $parentCategory = null;
        if ($Categories->parent_id) {
            $parentCategory = Category::find($Categories->parent_id);
        }
        return view('admin.categories.edit', compact('Categories', 'SubCategories', 'parentCategory'));
    }

    public function update(Request $request, int $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $data = $request->all();
        if (empty($data['parent_id'])) {
            $data['parent_id'] = null;
        }

        $oldParentId = $category->parent_id;
        $category->update($data);

        if ($category->parent_id) {
            return redirect()->route('admin.categories.subcategories', $category->parent_id)
                ->with('success', 'Danh mục đã được cập nhật thành công.');
        } elseif ($oldParentId && !$category->parent_id) {
            return redirect()->route('admin.categories.index')
                ->with('success', 'Danh mục đã được cập nhật và chuyển thành danh mục gốc.');
        } else {
            return redirect()->route('admin.categories.index')
                ->with('success', 'Danh mục đã được cập nhật thành công.');
        }
    }
    public function softDestroy($id)
    {
        $Categories = Category::findOrFail($id);
        $Categories->update(['status' => 3]);
        if ($Categories->parent_id) {
            return redirect()->route('admin.categories.subcategories', $Categories->parent_id)
                ->with('success', 'Danh mục đã được chuyển vào thùng rác.');
        } else {
            return redirect()->route('admin.categories.index')
                ->with('success', 'Danh mục đã được chuyển vào thùng rác.');
        }
    }
    public function destroy($id)
    {
        $Categories = Category::findOrFail($id);
        $Categories->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Categories deleted successfully.');
    }
    public function trash()
    {
        $categories = Category::where('status', 3)->get();
        return view('admin.categories.trash', compact('categories'));
    }
    public function restore($id)
    {
        $Categories = Category::findOrFail($id);
        $Categories->update(['status' => 1]);
        return redirect()->route('admin.categories.trash')->with('success', 'Categories restored successfully.');
    }
    public function forceDelete($id)
    {
        $category = Category::findOrFail($id);
        $subcategories = Category::where('parent_id', $category->id)->get();
        foreach ($subcategories as $subcategory) {
            Product::where('category_id', $subcategory->id)
                ->update(['category_id' => 0]);
            $subcategory->delete();
        }
        Product::where('category_id', $category->id)
            ->update(['category_id' => 0]);
        $category->delete();

        return redirect()->route('admin.categories.trash')->with('success', 'Categories permanently deleted successfully.');
    }
    public function subcategories($id)
    {
        $category = Category::where('id', $id)->where('status', '<>', 3)->firstOrFail();
        $subcategories = Category::where('parent_id', $id)->where('status', '<>', 3)->get();
        $parent = Category::find($category->parent_id);
        return view('admin.categories.subcategories', compact('category', 'subcategories', 'parent'));
    }
}
