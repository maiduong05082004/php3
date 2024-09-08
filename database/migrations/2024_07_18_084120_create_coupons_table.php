<?php

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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('discount', 8, 2);
            $table->enum('discount_type', ['fixed', 'percent']);
            $table->timestamp('valid_from')->nullable();
            $table->timestamp('valid_until')->nullable();
            $table->enum('status', ['active', 'expired', 'used'])->default('active');
            $table->integer('usage_limit')->nullable(); // Số lần sử dụng tối đa
            $table->integer('used_count')->default(0); // Số lần đã sử dụng
            $table->decimal('min_order_value', 8, 2)->nullable(); // Giá trị đơn hàng tối thiểu
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
