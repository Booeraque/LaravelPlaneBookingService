<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shopping_carts', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete(); // Foreign key to customers
            $table->timestamps();
        });

        // Pivot table to store planes added to a shopping cart
        Schema::create('cart_planes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('shopping_carts')->cascadeOnDelete();
            $table->foreignId('plane_id')->constrained('planes')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_planes');
        Schema::dropIfExists('shopping_carts');
    }
};
