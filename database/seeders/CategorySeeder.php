<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Tạo 10 danh mục cấp cao nhất
        Category::factory()->count(5)->create();

        // Tạo 5 danh mục con cho mỗi danh mục cấp cao nhất
        Category::all()->each(function ($category) {
            Category::factory()->count(5)->create(['parent_id' => $category->id]);
        });
    }
}
