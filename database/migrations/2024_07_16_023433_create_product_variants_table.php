<?php

use App\Models\color;
use App\Models\imageLibrary;
use App\Models\product;
use App\Models\size;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(product::class)->constrained();
            $table->foreignIdFor(color::class)->constrained();
            $table->foreignIdFor(size::class)->constrained();
            $table->foreignIdFor(imageLibrary::class, 'image_libraries_id')->constrained();
            $table->integer('stock')->default(0);
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
