<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    public function run()
    {
        Color::factory()->count(10)->create();
    }
}
