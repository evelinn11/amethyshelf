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
        Schema::create('carts', function (Blueprint $table) {
            $table->string('carts_id', 16)->primary();
            
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');

            $table->boolean('carts_status_del')->default(false);
            $table->timestamps();
        });

        Schema::create('cart_details', function (Blueprint $table) {
            $table->id();
            $table->string('carts_id',16);
            $table->foreign('carts_id')->references('carts_id')
            ->on('carts')->onDelete('cascade');

            $table->unsignedBigInteger('products_id');
            $table->foreign('products_id')->references('id')
            ->on('products')->onDelete('cascade');

            $table->decimal('cart_details_price');
            $table->integer('cart_details_amount');
            $table->boolean('cart_details_status_del')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
        Schema::dropIfExists('cart_details');
    }
};