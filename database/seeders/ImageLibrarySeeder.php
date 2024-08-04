<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ImageLibrary;

class ImageLibrarySeeder extends Seeder
{
    public function run()
    {
        ImageLibrary::factory()->count(10)->create();
    }
}
