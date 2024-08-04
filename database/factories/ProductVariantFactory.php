<?php
namespace Database\Factories;

use App\Models\ProductVariant;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\ImageLibrary;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;

    public function definition()
    {
        $product = Product::inRandomOrder()->first();
        $color = Color::inRandomOrder()->first();
        $size = Size::inRandomOrder()->first();
        $imageLibrary = ImageLibrary::inRandomOrder()->first();

        return [
            'product_id' => $product ? $product->id : Product::factory(),
            'color_id' => $color ? $color->id : Color::factory(),
            'size_id' => $size ? $size->id : Size::factory(),
            'image_libraries_id' => $imageLibrary ? $imageLibrary->id : ImageLibrary::factory(), // sử dụng đúng tên cột
            'stock' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(2, 1, 1000),
        ];
    }
}