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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('products_title');
            $table->string('products_author_name');
            $table->string('products_publisher_name');
            $table->year('products_published_year');
            $table->decimal('products_price',10, 0);
            $table->unsignedBigInteger('products_stock');
            $table->text('products_summary');
            $table->string('products_isbn');
            $table->string('products_total_pages');
            $table->string('products_languange');
            // $table->boolean('products_status_del');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
