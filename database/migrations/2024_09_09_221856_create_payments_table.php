<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // Liên kết với bảng orders
            $table->string('payment_method'); // Phương thức thanh toán
            $table->string('payment_id')->nullable(); // ID giao dịch từ PayPal
            $table->string('payer_id')->nullable(); // ID người thanh toán
            $table->decimal('amount', 10, 2); // Số tiền thanh toán
            $table->string('currency')->default('USD'); // Đơn vị tiền tệ
            $table->string('payment_status'); // Trạng thái thanh toán
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}