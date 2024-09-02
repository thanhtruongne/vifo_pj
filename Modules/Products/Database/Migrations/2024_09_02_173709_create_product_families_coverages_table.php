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
        Schema::create('product_families_coverages', function (Blueprint $table) {
            $table->id();
            $table->string('label_en')->nullable();
            $table->string('label_vn')->nullable();
            $table->string('desc_en')->nullable();
            $table->string('desc_vn')->nullable();
            $table->string('required')->nullable();
            $table->string('sort')->nullable();
            $table->string('filter')->nullable();
            $table->string('field_type')->nullable();
            $table->string('position')->nullable();
            $table->string('data_type')->nullable();
            $table->string('coverage_type')->nullable()->comment('Loại bảo hiểm');
            $table->string('unique_key')->nullable();
            $table->unsignedBigInteger('product_family_id')->index()->nullable(); 
            
            // $table->foreign('product_family_id')->references('id')->on('product_families')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_families_coverages');
    }
};
