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
            $table->string('logo')->nullable();
            $table->string('code')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_vn')->nullable();
            $table->string('desc_en')->nullable();
            $table->string('desc_vn')->nullable();
            $table->string('slug_en')->nullable();
            $table->string('slug_vn')->nullable();
            $table->text('highlighted_text_en')->nullable();
            $table->text('highlighted_text_vn')->nullable();
            $table->string('valid_from')->nullable();
            $table->string('valid_to')->nullable();
            $table->string('version')->nullable();
            $table->integer('position')->nullable();
            $table->string('external_link')->nullable();
            $table->string('commission')->nullable();
            $table->tinyInteger('activated')->default('0');
            $table->tinyInteger('partnership')->default('0');
            $table->tinyInteger('lead_capture')->default('0');
            $table->tinyInteger('has_promotion')->default('0');
            $table->integer('evaluation')->nullable();
            $table->tinyInteger('contact_us')->default('0');
            $table->tinyInteger('vifo_choice')->default('0');

            $table->unsignedBigInteger('product_family_id')->index()->nullable();
            $table->unsignedBigInteger('providers_id')->index()->nullable();
            $table->unsignedBigInteger('rank_id')->index()->nullable();


            // $table->foreign('product_family_id')->references('id')->on('product_families')->onDelete('cascade');
            // $table->foreign('providers_id')->references('id')->on('providers')->onDelete('cascade');
            // $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('cascade');
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
