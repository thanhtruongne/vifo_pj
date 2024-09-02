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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('code',50)->index();
            $table->unsignedBigInteger('catalog_id')->nullable();
            $table->string('name')->index()->nullable();
            $table->text('desc')->nullable();
            $table->text('address')->nullable();
            $table->string('company_information')->nullable();
            $table->string('business_licence_number')->nullable()->comment('số giấy phép kinh doanh');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
