<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('cashier_id')->constrained('users')->onDelete('cascade');
            $table->string('customer_name')->nullable();
            $table->enum('status', ['menunggu', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->decimal('total', 10, 2);
            $table->decimal('amount_paid', 10, 2);
            $table->decimal('change', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};