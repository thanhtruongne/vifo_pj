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
        Schema::create('product_coverages', function (Blueprint $table) {
            $table->id();
            $table->string('value')->nullable();

            $table->unsignedBigInteger('products_id')->index()->nullable();
            // $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');

            $table->unsignedBigInteger('product_family_id')->index()->nullable(); 
            // $table->foreign('product_family_id')->references('id')->on('product_families')->onDelete('cascade');
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_coverages');
    }
};
