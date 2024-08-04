<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class DefaultCategorySeeder extends Seeder
{
    public function run()
    {
        Category::firstOrCreate(
            ['name' => 'Không có danh mục'],
            ['status' => '1']
        );
    }
}
