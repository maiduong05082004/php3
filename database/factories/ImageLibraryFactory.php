<?php

namespace Database\Factories;

use App\Models\ImageLibrary;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageLibraryFactory extends Factory
{
    protected $model = ImageLibrary::class;

    public function definition()
    {
        return [
            'url' => $this->faker->imageUrl(),
        ];
    }
}
