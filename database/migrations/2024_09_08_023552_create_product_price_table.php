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
        Schema::create('product_price', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['dailyterm', 'monthlyterm','yearlyterm','6_monthsterm','quarterlyterm','tripterm','percentterm'])->nullable();
            $table->float('exc_tax_price')->nullable()->comment('giá trừ thuế');
            $table->float('inc_tax_price')->nullable();
            $table->float('extra_price')->nullable();
            $table->float('discount')->nullable();
            $table->float('quantity_discount')->nullable();
            
            $table->unsignedBigInteger('products_id')->index()->nullable();
            // $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_price');
    }
};
