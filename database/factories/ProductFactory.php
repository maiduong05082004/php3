<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'category_id' => Category::inRandomOrder()->first()->id,
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->paragraph,
        ];
    }
}
